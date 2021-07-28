<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin\Controllers\Util;
use App\Models\Category;
use App\Models\Page;
use App\Models\Photo;
use App\Models\Song;
use App\Models\Author;
use App\Models\User;
use App\Models\Plan;
use App\Models\Rating;
use App\Models\Banner;
use App\Models\Order;
use App\Models\Comment;
use Carbon\Carbon;

class PageController extends Controller
{
    //
    public function index()
    {
        return view('welcome', []);
    }

    public function view($slug)
    {
        $page = Page::where('slug', $slug)->first();
        $page->view = $page->view + 1;
        $page->save();
        $cat = Category::find($page->category_id);
        $author = Author::where("admin_user_id", $page->author_id)->first();
        $photos = Photo::where("album_id", $page->id)->get();
        $songs = Song::where("podcast_id", $page->id)->get();
        $banner = Banner::where("position", 2)->where("show", 1)->first();
        $countRating = Rating::where('page_id', $page->id)->count();
        $sumRating = Rating::where('page_id', $page->id)->sum("rate");
        $comments = Comment::where('page_id', $page->id)->where("verify", 1)->orderBy("id", "DESC")->limit(50)->get();

        $rate = null;
        if (\Auth::user()){
            $rate = Rating::where("user_id", \Auth::user()->id)->where("page_id", $page->id)->first();
        }
        
        $trial = true;
        $view = 'template.covid_post';
        if ($page->type == 1){
            $view = 'template.image_post';
        }
        if ($page->type == 2){
            $view = 'template.podcast_episodes';
        }
        if ($page->free){
            $trial = false;
        } else if (\Auth::user()) {  
            $user = User::find(\Auth::user()->id);
            if ($user->package_type == 1){
                $trial = false;
            }
            if ($user->package_type == 0 && $page->trial == 1){
                $trial = false;
            }
        } 
        return view($view, ["page" => $page, "photos" => $photos, "songs" => $songs, "trial" => $trial,
        "rate" => $rate, "comments" => $comments,
        "banner" => $banner, "rating" => array("number" => $countRating, "total" => $sumRating),
        "cat" => $cat, "author" => $author]);
    }

    public function search()
    {
        $q = $_GET['q'];
        $countComments = Comment::where('verify', 1)
        ->selectRaw('page_id, count(*) as total')
        ->groupBy('page_id')
        ->pluck('total','page_id')->all();
        $countRatings = Rating::selectRaw('page_id, count(*) as total')
        ->groupBy('page_id')
        ->pluck('total','page_id')->all();
        $sumRatings = Rating::selectRaw('page_id, sum(rate) as total')
        ->groupBy('page_id')
        ->pluck('total','page_id')->all();

        $pages = Page::whereRaw("MATCH (title, description, content) AGAINST (? IN BOOLEAN MODE)", Util::fullTextWildcards($q))->paginate(5);
        return view("template.search", ["q" => $q, 'pages' => $pages, 'countComments' => $countComments,
        'countRatings' => $countRatings, 'sumRatings' => $sumRatings]);
    }

    public function contact()
    {
        return view('template.contact', []);
    }

    public function vnpayIpn() {
        /*
        * IPN URL: Ghi nhận kết quả thanh toán từ VNPAY
        * Các bước thực hiện:
        * Kiểm tra checksum 
        * Tìm giao dịch trong database
        * Kiểm tra tình trạng của giao dịch trước khi cập nhật
        * Cập nhật kết quả vào Database
        * Trả kết quả ghi nhận lại cho VNPAY
        */

        $inputData = array();
        $returnData = array();
        $data = $_REQUEST;
        foreach ($data as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        if(!array_key_exists("vnp_SecureHash", $inputData)){
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
            return json_encode($returnData);
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $secureHash = hash('sha256',env('vnp_HashSecret') . $hashData);
        $status = 0;
        $orderId = $inputData['vnp_TxnRef'];

        try {
            //Check Orderid    
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);   
                $order = Order::where("order_code", $orderId)->first();
                if ($order != NULL) {
                    if ($order["status"] != NULL && $order["status"] == 0) {
                        if ($inputData['vnp_ResponseCode'] == '00') {
                            $status = 1;
                        } else {
                            $status = 2;
                        }
                        $order->status = $status;
                        $order->payment_type = $inputData['vnp_CardType'];
                        $user = User::find($order->user_id);
                        $plan = Plan::find($order->plan_id);
                        if ($user->package_type == 1){
                            // Người dùng vẫn đang sử dụng dịch vụ;
                            $lastEndDate = new Carbon($user->expire_time);
                            $newEndDate = new Carbon($user->expire_time);
                            $newEndDate->addMonth($plan->duration + $plan->added_month);
                            $order->start_date = $lastEndDate;
                            $order->end_date= $newEndDate;
                            $user->expire_time = $newEndDate;
                        } else {
                            $lastEndDate = Carbon::now();
                            $newEndDate = Carbon::now();
                            $newEndDate->addMonth($plan->duration + $plan->added_month);
                            $order->start_date = $lastEndDate;
                            $order->end_date= $newEndDate;
                            $user->expire_time = $newEndDate;  
                            $user->package_type = 1;
                        }
                        $user->save();
                        $order->save();
                        //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                        //
                        //
                        //
                        //Trả kết quả về cho VNPAY: Website TMĐT ghi nhận yêu cầu thành công                
                        $returnData['RspCode'] = '00';
                        $returnData['Message'] = 'Confirm Success';
                    } else {
                        $returnData['RspCode'] = '02';
                        $returnData['Message'] = 'Order already confirmed';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Chu ky khong hop le';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
        //Trả lại VNPAY theo định dạng JSON
        echo json_encode($returnData);
    }
}

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
        * IPN URL: Ghi nh???n k???t qu??? thanh to??n t??? VNPAY
        * C??c b?????c th???c hi???n:
        * Ki???m tra checksum 
        * T??m giao d???ch trong database
        * Ki???m tra t??nh tr???ng c???a giao d???ch tr?????c khi c???p nh???t
        * C???p nh???t k???t qu??? v??o Database
        * Tr??? k???t qu??? ghi nh???n l???i cho VNPAY
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
        $vnpTranId = $inputData['vnp_TransactionNo']; //M?? giao d???ch t???i VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ng??n h??ng thanh to??n
        $secureHash = hash('sha256',env('vnp_HashSecret') . $hashData);
        $status = 0;
        $orderId = $inputData['vnp_TxnRef'];

        try {
            //Check Orderid    
            //Ki???m tra checksum c???a d??? li???u
            if ($secureHash == $vnp_SecureHash) {
                //L???y th??ng tin ????n h??ng l??u trong Database v?? ki???m tra tr???ng th??i c???a ????n h??ng, m?? ????n h??ng l??: $orderId            
                //Vi???c ki???m tra tr???ng th??i c???a ????n h??ng gi??p h??? th???ng kh??ng x??? l?? tr??ng l???p, x??? l?? nhi???u l???n m???t giao d???ch
                //Gi??? s???: $order = mysqli_fetch_assoc($result);   
                $order = Order::where("order_code", $orderId)->first();
                if ($order != null) {
                    if (strval($order->price * 100) == $inputData['vnp_Amount']) {
                        if ($order["status"] != null && $order["status"] == 0) {
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
                                // Ng?????i d??ng v???n ??ang s??? d???ng d???ch v???;
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
                            //C??i ?????t Code c???p nh???t k???t qu??? thanh to??n, t??nh tr???ng ????n h??ng v??o DB
                            //
                            //
                            //
                            //Tr??? k???t qu??? v??? cho VNPAY: Website TM??T ghi nh???n y??u c???u th??nh c??ng                
                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'Invalid amount';
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
        //Tr??? l???i VNPAY theo ?????nh d???ng JSON
        echo json_encode($returnData);
    }
}

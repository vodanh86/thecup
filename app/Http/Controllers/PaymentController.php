<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin\Controllers\Util;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Page;
use App\Models\Order;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createPayment(Request $request)
    {
        $vnp_TxnRef = $request->order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => env('vnp_TmnCode'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => env('vnp_Returnurl'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = env('vnp_Url') . "?" . $query;
        if (env('vnp_HashSecret')) {
           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
               $vnpSecureHash = hash('sha256', env('vnp_HashSecret') . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
        //header('Location: '.$vnp_Url);
        return redirect()->to($vnp_Url);
    }

    public function vnpayResult(Request $request){
        $payment = Payment::where("txn_ref", $request->txn_ref)->first();
        return view('template.vnpayReturn', ["payment" => $payment]);
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
        $Status = 0;
        $orderId = $inputData['vnp_TxnRef'];

        try {
            //Check Orderid    
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);   
                $order = NULL;
                if ($order != NULL) {
                    if ($order["Status"] != NULL && $order["Status"] == 0) {
                        if ($inputData['vnp_ResponseCode'] == '00') {
                            $Status = 1;
                        } else {
                            $Status = 2;
                        }
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

    public function vnpayReturn()
    {
        /*return view('template.vnpayReturn');
        if ($_GET["vnp_ResponseCode"] == 24){
            $order = Order::where("order_code", $_GET["vnp_TxnRef"])->first();
            $order->status = 2;
            $order->save();
            return redirect()->to(url('user/profile'))->with('success','Thanh toán không thành công');
        }*/
        $payment = new Payment();
        $payment->vnp_securehashtype = $_GET['vnp_SecureHashType'];
        $payment->vnp_securehash = $_GET['vnp_SecureHash'];
        $payment->amount = $_GET["vnp_Amount"];
        $payment->bank_code = $_GET["vnp_BankCode"];
        $payment->bank_tran_no = isset($_GET["vnp_BankTranNo"]) ? $_GET["vnp_BankTranNo"] : "";
        $payment->card_type = $_GET["vnp_CardType"];
        $payment->order_info = $_GET["vnp_OrderInfo"];
        $payment->paydate = $_GET["vnp_PayDate"];
        $payment->response_code = $_GET["vnp_ResponseCode"];
        $payment->tmn_code = $_GET["vnp_TmnCode"];
        $payment->transaction_no = $_GET["vnp_TransactionNo"];
        $payment->txn_ref = $_GET["vnp_TxnRef"];
        $payment->vnp_web = isset($_GET['customer_id']) ? $_GET["vnpweb"] : "";
        $payment->vnp_checkhash = Util::checkHash();
        $payment->save();
        return redirect()->to(url('payment/vnpayResult?txn_ref=').$payment->txn_ref);
    }
}

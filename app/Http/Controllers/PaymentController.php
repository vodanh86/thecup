<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Page;
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

    public function vnpayReturn()
    {
        $payment = new Payment();
        $payment->amount = $_GET["vnp_Amount"];
        $payment->bank_code = $_GET["vnp_BankCode"];
        $payment->bank_tran_no = $_GET["vnp_BankTranNo"];
        $payment->card_type = $_GET["vnp_CardType"];
        $payment->order_info = $_GET["vnp_OrderInfo"];
        $payment->paydate = $_GET["vnp_PayDate"];
        $payment->response_code = $_GET["vnp_ResponseCode"];
        $payment->tmn_code = $_GET["vnp_TmnCode"];
        $payment->transaction_no = $_GET["vnp_TransactionNo"];
        $payment->txn_ref = $_GET["vnp_TxnRef"];
        $payment->vnp_web = isset($_GET['customer_id']) ? $_GET["vnpweb"] : "";
        $payment->save();
        return redirect()->to(url('user/profile'))->with('success','Thanh toán thành công');
    }
}

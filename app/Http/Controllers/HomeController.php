<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('welcome', []);
    }

    public function subscribe()
    {
        return view('subscribe', []);
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
        var_dump($_GET);
        return view('subscribe', []);
    }
}

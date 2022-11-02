<?php

use App\Membership;
use App\User;
use Illuminate\Http\Request;

// function processVNPay($idOrder)
// {

//     $order = Order::findOrFail($idOrder);
//     if($order->status == 'Hủy đơn hàng'){
//         return redirect('/home');
//     }

//     $amount = $order->total;

//     $vnp_TmnCode = "9U6ZKSYR"; //Mã website tại VNPAY 
//     $vnp_HashSecret = "EYNUXNVNDAARRLXHNSFLHBQSOJCFQTLW"; //Chuỗi bí mật
//     $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
//     $vnp_Returnurl = url("home/process/return-vnpay/$idOrder");
//     $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
//     $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
//     $vnp_OrderType = 'billpayment';
//     $vnp_Amount = $amount * 100;
//     $vnp_Locale = 'vn';
//     $vnp_IpAddr = request()->ip();

//     $inputData = array(
//         "vnp_Version" => "2.0.0",
//         "vnp_TmnCode" => $vnp_TmnCode,
//         "vnp_Amount" => $vnp_Amount,
//         "vnp_Command" => "pay",
//         "vnp_CreateDate" => date('YmdHis'),
//         "vnp_CurrCode" => "VND",
//         "vnp_IpAddr" => $vnp_IpAddr,
//         "vnp_Locale" => $vnp_Locale,
//         "vnp_OrderInfo" => $vnp_OrderInfo,
//         "vnp_OrderType" => $vnp_OrderType,
//         "vnp_ReturnUrl" => $vnp_Returnurl,
//         "vnp_TxnRef" => $vnp_TxnRef,
//     );

//     if (isset($vnp_BankCode) && $vnp_BankCode != "") {
//         $inputData['vnp_BankCode'] = $vnp_BankCode;
//     }
//     ksort($inputData);
//     $query = "";
//     $i = 0;
//     $hashdata = "";
//     foreach ($inputData as $key => $value) {
//         if ($i == 1) {
//             $hashdata .= '&' . $key . "=" . $value;
//         } else {
//             $hashdata .= $key . "=" . $value;
//             $i = 1;
//         }
//         $query .= urlencode($key) . "=" . urlencode($value) . '&';
//     }

//     $vnp_Url = $vnp_Url . "?" . $query;
//     if (isset($vnp_HashSecret)) {
//        // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
//         $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
//         $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
//     }

//     return redirect($vnp_Url);
// }

// function processVNPaySuccess($idOrder, Request $request) {
//     // dd($request->vnp_ResponseCode);
//     if($request->vnp_ResponseCode != '00'){
//         return redirect('/home/profile');
//     }
//     $order = Order::findOrFail($idOrder);

//     $order->status_payment = 1;
//     $order->save();

//     $emailTo = Auth::user()->email;
//     Mail::to($emailTo)->send(new OrderEmail($order));

//     return redirect('/home/profile');
// }

// function processMoMoSuccess($idOrder, Request $request) {
//     if($request->resultCode != '0'){
//         return redirect('/home/profile');
//     }
//     $order = Order::findOrFail($idOrder);

//     $order->status_payment = 1;
//     $order->save();

//     $emailTo = Auth::user()->email;
//     Mail::to($emailTo)->send(new OrderEmail($order));

//     return redirect('/home/profile');
// }
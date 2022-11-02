<?php

namespace App\Services\PaymentService;

use App\Services\PaymentService\Entities\EntityProcess;
use App\Services\PaymentService\Entities\EntityTransaction;
use App\User;

class VNPayService extends PaymentService {
    // public $ENDPOINT = "https://test-payment.momo.vn/v2/gateway/api/create";
    public $ENDPOINT = "http://sandbox.vnpayment.vn/";
    public $NAME = "VNPAY";

    public function process(EntityProcess $entity) {
        $url = $this->generateURL($entity);
        // dd($url);
        $response = [
            'payUrl' => $url
        ];
        return $response;
    }

    public function generateURL(EntityProcess $entity) {
        $idUser = $entity->idUser;
        $amount = $entity->amount;
        $idMembership =  $entity->idMembership;
        
        $endpoint = $this->ENDPOINT . 'paymentv2/vpcpay.html';
        $user = User::findOrFail($idUser);

        $encryptedInformation = base64_encode(serialize(array(
            'idUser' => $idUser,
            'idMembership' => $idMembership,
            'payment' => $this->NAME
        )));

        $amount = $entity->amount;

        $vnp_TmnCode = "9U6ZKSYR"; //Mã website tại VNPAY 
        $vnp_HashSecret = "EYNUXNVNDAARRLXHNSFLHBQSOJCFQTLW"; //Chuỗi bí mật
        $vnp_Url = $endpoint;
        $vnp_Returnurl = url("process/return-payment/vnpay/$encryptedInformation");
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $amount * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
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

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    public function statusTransaction(entityTransaction $entity) {
        $vnp_HashSecret = "EYNUXNVNDAARRLXHNSFLHBQSOJCFQTLW"; //Chuỗi bí mật
        $vnp_SecureHash = $entity->vnp_SecureHash;
        $inputData = array();
        // dd($entity->attributes);
        foreach ($entity->attributes as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        // dd($vnp_SecureHash. '//////' . $secureHash);
        $response['code'] = 1;
        if ($inputData['vnp_ResponseCode'] == '00'){
            $response['code'] = 0;
        }
        // if ($secureHash == $vnp_SecureHash) {
        //     $response['code'] = 0;
        // }
        
        return $response;
    }
}
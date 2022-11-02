<?php

namespace App\Services\PaymentService;

use App\Services\PaymentService\Entities\EntityProcess;
use App\Services\PaymentService\Entities\EntityTransaction;
use App\User;

class MomoService extends PaymentService {
    // public $ENDPOINT = "https://test-payment.momo.vn/v2/gateway/api/create";
    public $ENDPOINT = "https://test-payment.momo.vn/";
    public $PARTNERCODE = "MOMOBKUN20180529";
    public $ACCESSKEY = "klm05TvNBzhg7h7j";
    public $SECRETKEY = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
    public $NAME = "MOMO";

    public function process(EntityProcess $entity) {
        $idUser = $entity->idUser;
        $amount = $entity->amount;
        $idMembership =  $entity->idMembership;
        
        $endpoint = $this->ENDPOINT . 'v2/gateway/api/create';
        $user = User::findOrFail($idUser);
        $encryptedInformation = encrypt(array(
            'idUser' => $idUser,
            'idMembership' => $idMembership,
            'payment' => $this->NAME
        ));
    
        $orderInfo = "Thanh toán qua MoMo";
        $amount = (int) $amount;
        $orderId = time() ."";
        $redirectUrl = url("process/return-payment/momo/$encryptedInformation");
        $ipnUrl = url("process/return-payment/momo/$encryptedInformation");
        $extraData = "";
        $requestId = time() . "";
        $requestType = "onDelivery";
        $rawHash = "accessKey=" . $this->ACCESSKEY . 
                    "&amount=" . $amount . 
                    "&extraData=" . $extraData . 
                    "&ipnUrl=" . $ipnUrl . 
                    "&orderId=" . $orderId . 
                    "&orderInfo=" . $orderInfo . 
                    "&partnerCode=" . $this->PARTNERCODE . 
                    "&redirectUrl=" . $redirectUrl . 
                    "&requestId=" . $requestId . 
                    "&requestType=" . $requestType;
        
        $signature = hash_hmac(
            "sha256", $rawHash, $this->SECRETKEY
        );
        $data = array(
            'partnerCode' => $this->PARTNERCODE,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);

        $result = execRequest(
            $endpoint, 
            json_encode($data), 
            "POST",
            array(
                'Content-Type: application/json'
            )
        );
        $jsonResult = json_decode($result, true);
    
        return $jsonResult;
    }

    public function statusTransaction(entityTransaction $entity) {
        $requestId = $entity->requestId;
        $orderId = $entity->orderId;
        $endpoint = $this->ENDPOINT . "gw_payment/transactionProcessor";
        $requestType = "transactionStatus";
        $rawHash = "partnerCode=".$this->PARTNERCODE.
                    "&accessKey=".$this->ACCESSKEY.
                    "&requestId=".$requestId.
                    "&orderId=".$orderId.
                    "&requestType=".$requestType;
        $signature = hash_hmac("sha256", $rawHash, $this->SECRETKEY);
        $data = array(
            'partnerCode' => $this->PARTNERCODE,
            'accessKey' => $this->ACCESSKEY,
            'requestId' => $requestId,
            'orderId' => $orderId,
            'requestType' => $requestType,
            'signature' => $signature
        );
    
        $result = execRequest(
            $endpoint, 
            json_encode($data), 
            "POST",
            array(
                'Content-Type: application/json'
            )
        );
        $jsonResult = json_decode($result, true);
        
        return $jsonResult;
    }
}
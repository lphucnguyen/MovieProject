<?php

namespace App\Services\PaymentService;

use App\Services\PaymentService\PaymentService;
use Exception;

class FactoryPaymentService {
    private static PaymentService $paymentService;
    private static FactoryPaymentService $instance;
    private static $NAME_PAYMENT_SERVICES = [
        'MOMO' => MomoService::class,
        'VNPAY' => VNPayService::class
    ];

    public static function createPaymentService(string $name): FactoryPaymentService {
        $name = strtoupper($name);
        if(!isset(self::$NAME_PAYMENT_SERVICES[$name])){
            throw new Exception("Name of Payment Service is not valid");
        }

        self::$paymentService = new self::$NAME_PAYMENT_SERVICES[$name];
        if(!isset(self::$instance)) {
            self::$instance =  new static();
        }

        return self::$instance;
    }    

    public static function get(): PaymentService {
        return self::$paymentService;
    }
}
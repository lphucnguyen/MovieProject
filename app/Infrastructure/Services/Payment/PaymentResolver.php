<?php

namespace App\Infrastructure\Services\Payment;

class PaymentResolver
{
    public function resolveService($serviceName)
    {
        $service = config("services.{$serviceName}.class");

        if ($service) {
            return resolve($service);
        }

        throw new \Exception('The selected platform is not in the configuration');
    }
}
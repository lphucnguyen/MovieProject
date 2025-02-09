<?php

namespace App\Infrastructure\Services\Payment;

use App\Application\DTOs\Payment\ApprovalPaymentDTO;
use App\Shared\Application\DTOs\BaseDTO;
use App\Application\DTOs\Payment\PaypalDTO;
use App\Shared\Traits\ConsumeExternalService;
use InvalidArgumentException;

class PaypalService implements IPaymentService
{
    use ConsumeExternalService;

    private $baseUri;
    private $clientId;
    private $clientSecret;
    private $plans;

    public function __construct()
    {
        $this->baseUri = config('services.paypal.base_uri');
        $this->clientId = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');
        $this->plans = config('services.paypal.plans');
    }

    private function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    private function decodeResponse($response)
    {
        return json_decode($response);
    }

    private function resolveAccessToken() {
        return "Basic " . base64_encode("{$this->clientId}:{$this->clientSecret}");
    }

    public function handlePayment(BaseDTO $paypalDTO)
    {
        if (!$paypalDTO instanceof PaypalDTO) {
            throw new InvalidArgumentException('Expected StripeDTO');
        }

        $order = $this->createOrder(
            $paypalDTO->amount,
            config('services.currency'),
            route('approval',
                [
                    'plan_id' => $paypalDTO->plan_id,
                    'lock_owner' => $paypalDTO->lock_owner,
                    'order_id' => $paypalDTO->order_id,
                    'payment_name' => $paypalDTO->payment_name,
                ]
            ),
            route('cancelled')
        );

        $orderLinks = collect($order->links);

        $approve = $orderLinks->where('rel', 'approve')->first();

        session()->put('approvalId', $order->id);

        return [
            'paymentId' => $order->id,
            'redirect' => $approve->href,
        ];
    }

    public function handleApproval(BaseDTO $approvalDTO)
    {
        if (!($approvalDTO instanceof ApprovalPaymentDTO)) {
            throw new InvalidArgumentException('Expected ApprovalPaymentDTO');
        }

        if (session()->has('approvalId')) {
            $approvalId = session()->get('approvalId');

            $payment = $this->capturePayment($approvalId);
            $captureId = $payment->purchase_units[0]->payments->captures[0]->id;

            return $captureId;
        }

        throw new \Exception('Approval Id is not valid');
    }

    public function capturePayment($approvalId)
    {
        return $this->makeRequest(
            'POST',
            "/v2/checkout/orders/{$approvalId}/capture",
            [],
            [],
            [
                'Content-Type' => 'application/json'
            ],
        );
    }

    public function createOrder($value, $currency, $returnUrl, $cancelUrl, $idempotencyKey = null)
    {
        return $this->makeRequest(
            'POST',
            '/v2/checkout/orders',
            [],
            [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    0 => [
                        'amount' => [
                            'currency_code' =>strtoupper($currency),
                            'value' => round($value * $factor = $this->resolveFactor($currency)) / $factor,
                        ]
                    ]
                ],
                'application_context' => [
                    'brand_name' => config('app.name'),
                    'shipping_preference' => 'NO_SHIPPING',
                    'user_action' => 'PAY_NOW',
                    'return_url' => $returnUrl,
                    'cancel_url' => $cancelUrl,
                ]
            ],
            [],
            $isJsonRequest = true,
        );
    }

    public function resolveFactor($currency)
    {
        $zeroDecimalCurrencies = ['JPY'];

        if (in_array(strtoupper($currency), $zeroDecimalCurrencies)) {
            return 1;
        }

        return 100;
    }

    public function cancelPayment($approvalId)
    {
        return $this->makeRequest(
            'DELETE',
            "v1/checkout/orders/{$approvalId}",
            [],
            [],
            [
                'Content-Type' => 'application/json'
            ],
        );
    }

    public function refundPayment($approvalId) {
        return $this->makeRequest(
            'POST',
            "/v2/payments/captures/{$approvalId}/refund",
            [],
            [],
            [
                'Content-Type' => 'application/json'
            ],
        );
    }
}

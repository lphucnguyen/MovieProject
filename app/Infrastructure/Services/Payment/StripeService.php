<?php

namespace App\Infrastructure\Services\Payment;

use App\Application\DTOs\Payment\ApprovalPaymentDTO;
use App\Shared\Application\DTOs\BaseDTO;
use App\Application\DTOs\Payment\StripeDTO;
use App\Shared\Traits\ConsumeExternalService;
use InvalidArgumentException;

class StripeService implements IPaymentService
{
    use ConsumeExternalService;

    private string $baseUri;
    private string $clientId;
    private string $clientSecret;
    private array $plans;

    public function __construct()
    {
        $this->baseUri = config('services.stripe.base_uri');
        $this->clientId = config('services.stripe.key');
        $this->clientSecret = config('services.stripe.secret');
        $this->plans = config('services.stripe.plans');
    }

    public function handlePayment(BaseDTO $stripeDTO)
    {
        if (!($stripeDTO instanceof StripeDTO)) {
            throw new InvalidArgumentException('Expected StripeDTO');
        }

        $intent = $this->createIntent(
            $stripeDTO->amount,
            config('services.currency'),
            $stripeDTO->payment_method,
        );

        session()->put('paymentIntentId', $intent->id);

        return [
            'paymentId' => $intent->id,
            'redirect' => route('approval', [
                'plan_id' => $stripeDTO->plan_id,
                'lock_owner' => $stripeDTO->lock_owner,
                'order_id' => $stripeDTO->order_id,
                'payment_name' => $stripeDTO->payment_name,
            ]),
        ];
    }

    public function handleApproval(BaseDTO $approvalDTO)
    {
        if (!($approvalDTO instanceof ApprovalPaymentDTO)) {
            throw new InvalidArgumentException('Expected ApprovalPaymentDTO');
        }

        if (session()->has('paymentIntentId')) {
            $paymentIntentId = session()->get('paymentIntentId');

            $confirmation = $this->confirmPayment($paymentIntentId);

            if ($confirmation->status === 'requires_action') {
                $clientSecret = $confirmation->client_secret;

                return view('stripe.3d-secure')->with([
                    'clientSecret' => $clientSecret,
                ]);
            }

            if ($confirmation->status === 'succeeded') {
                return $paymentIntentId;
            }
        }

        throw new \Exception('Payment Id is not valid');
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    private function resolveAccessToken()
    {
        return "Bearer {$this->clientSecret}";
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function createIntent($value, $currency, $paymentMethod)
    {
        return $this->makeRequest(
            'POST',
            '/v1/payment_intents',
            [],
            [
                'amount' => round($value * $this->resolveFactor($currency)),
                'currency' => strtolower($currency),
                'payment_method' => $paymentMethod,
                'confirmation_method' => 'manual',
            ]
        );
    }

    private function resolveFactor($currency)
    {
        $zeroDecimalCurrencies = ['JPY'];

        if (in_array(strtoupper($currency), $zeroDecimalCurrencies)) {
            return 1;
        }

        return 100;
    }

    public function confirmPayment($paymentIntentId)
    {
        return $this->makeRequest(
            'POST',
            "/v1/payment_intents/{$paymentIntentId}/confirm",
            [],
            [
                'return_url' => route('approval'),
            ]
        );
    }

    public function cancelPayment($paymentIntentId)
    {
        return $this->makeRequest(
            'POST',
            "/v1/payment_intents/{$paymentIntentId}/cancel",
            [],
            [
                'cancellation_reason' => 'abandoned', // duplicate, fraudulent, requested_by_customer, or abandoned
            ]
        );
    }

    public function refundPayment($paymentIntentId)
    {
        return $this->makeRequest(
            'POST',
            "/v1/refunds",
            [],
            [
                'payment_intent' => $paymentIntentId,
                'reason' => 'requested_by_customer',
            ]
        );
    }
}
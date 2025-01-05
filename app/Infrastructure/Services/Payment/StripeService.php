<?php

namespace App\Infrastructure\Services\Payment;

use App\Application\DTOs\BaseDTO;
use App\Application\DTOs\Payment\StripeDTO;
use App\Domain\Repositories\IPlanRepository;
use App\Shared\Traits\ConsumeExternalService;
use InvalidArgumentException;

class StripeService implements IPaymentService
{
    use ConsumeExternalService;

    private string $baseUri;
    private string $clientId;
    private string $clientSecret;
    private array $plans;

    public function __construct(
        private IPlanRepository $planRepository
    )
    {
        $this->baseUri = config('services.stripe.base_uri');
        $this->clientId = config('services.stripe.key');
        $this->clientSecret = config('services.stripe.secret');
        $this->plans = config('services.stripe.plans');
    }

    public function handlePayment(BaseDTO $stripeDTO)
    {
        if (!$stripeDTO instanceof StripeDTO) {
            throw new InvalidArgumentException('Expected StripeDTO');
        }

        $plan = $this->planRepository->get($stripeDTO->plan_id);

        $intent = $this->createIntent(
            $plan->price,
            config('services.currency'),
            $stripeDTO->payment_method,
        );

        session()->put('paymentIntentId', $intent->id);

        return redirect()->route('approval');
    }

    public function handleApproval()
    {
        if (session()->has('paymentIntentId')) {
            $paymentIntentId = session()->get('paymentIntentId');

            $confirmation = $this->confirmPayment($paymentIntentId);

            if ($confirmation->status === 'requires_action') {
                $clientSecret = $confirmation->clientSecret;

                return view('stripe.3d-secure')->with([
                    'clientSecret' => $clientSecret,
                ]);
            }

            if ($confirmation->status === 'succeeded') {
                // $name = $confirmation->charges->data[0]->billing_details->name;
                $currency = strtoupper($confirmation->currency);
                $amount = $confirmation->amount / $this->resolveFactor($currency);

                return redirect()
                    ->route('user.upgrade-account')
                    ->withSuccess(__("Thank you. We received your {$amount}{$currency} payment."));
            }
        }

        return redirect()
            ->route('home')
            ->withErrors('We are unable to confirm your payment. Try again, please');
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
            ],
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
                'return_url' => route('user.upgrade-account'),
            ]
        );
    }
}
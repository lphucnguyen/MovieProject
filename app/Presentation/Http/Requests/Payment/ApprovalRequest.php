<?php

namespace App\Presentation\Http\Requests\Payment;

use App\Application\Enums\Payment\PaymentName;
use App\Domain\Enums\Order\OrderStatus;
use App\Domain\Repositories\IOrderRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ApprovalRequest extends FormRequest
{
    private IOrderRepository $orderRepository;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $this->orderRepository = app(IOrderRepository::class);

        return [
            'plan_id' => ['required', 'exists:plans,id'],
            'payment_name' => ['required', new Enum(PaymentName::class)],
            'order_id' => ['required', 'exists:orders,id', function ($attribute, $value, $fail) {
                $order = $this->orderRepository->get($value);

                if ($order && ($order->status === OrderStatus::COMPLETED->value || $order->status === OrderStatus::CANCELED->value)) {
                    $fail(__("Đơn hàng không thể thanh toán"));
                }
            }],
            'token' => [function ($attribute, $value, $fail) {
                if (request()->input('payment_name') === PaymentName::PAYPAL->value && !$value) {
                    $fail(__("Thiếu Token"));
                }
            }],
            'session_id' => [function ($attribute, $value, $fail) {
                if (request()->input('payment_name') === PaymentName::STRIPE->value && !$value) {
                    $fail(__("Thiếu Session Id"));
                }
            }]
        ];
    }
}

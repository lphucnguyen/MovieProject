<?php

namespace App\Presentation\Http\Requests\Payment;

use App\Domain\Repositories\IOrderRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

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
            'encrypt_data' => ['required', function ($attribute, $value, $fail) {
                try {
                    $decryptedData = json_decode(Crypt::decryptString($value), true);

                    if (!isset($decryptedData['order_id']) || !isset($decryptedData['payment_name']) || !isset($decryptedData['plan_id'])) {
                        throw new \Exception();
                    }
                } catch (\Exception) {
                    return $fail();
                }
            }],
            'token' => ['required']
        ];
    }
}

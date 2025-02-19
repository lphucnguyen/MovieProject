{{-- @push('style')
<style type="text/css">
    .StripeElement {
      box-sizing: border-box;
      height: 40px;
      padding: 10px 12px;
      border: 1px solid transparent;
      border-radius: 4px;
      background-color: white;
      box-shadow: 0 1px 3px 0 #e6ebf1;
      -webkit-transition: box-shadow 150ms ease;
      transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
      box-shadow: 0 1px 3px 0 #ffffff;
      color: #ffffff;
    }

    .StripeElement--invalid {
      border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }
</style>
@endpush
<label class="mt-3" for="card-element">
    {{__('Thông tin thẻ')}}:
</label>
<div id="cardElement"></div>
<small class="form-text text-muted" id="cardErrors" role="alert"></small>
<input type="hidden" name="payment_method" id="paymentMethod">
@push('script')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('services.stripe.key') }}');

    const elements = stripe.elements({ locale: 'en' });
    const cardElement = elements.create('card');

    cardElement.mount('#cardElement');
</script>

<script>
    const form = document.getElementById('paymentForm');
    const payButton = document.getElementById('payButton');

    payButton.addEventListener('click', async(e) => {
        if (form.elements.payment_name.value === "stripe") {
            e.preventDefault();

            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: {
                        "name": "{{ auth()->user()->last_name }}",
                        "email": "{{ auth()->user()->email }}"
                    }
                }
            );

            if (error) {
                const displayError = document.getElementById('cardErrors');

                displayError.textContent = error.message;
            } else {
                const tokenInput = document.getElementById('paymentMethod');

                tokenInput.value = paymentMethod.id;
                payButton.disabled = true;
                form.submit();
            }
        }
    });
</script>
@endpush --}}
<small class="text-light">You will be redirected to the Stripe checkout page.</small>
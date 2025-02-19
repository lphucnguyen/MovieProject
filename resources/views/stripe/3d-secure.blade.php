
<html>
    <head>
        <title>{{ __('Hoàn thanh các bước bảo mật') }}</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="page-single">
            <div class="container">
                <div class="row ipad-width">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header">{{ __('Hoàn thanh các bước bảo mật') }}</div>
                            <div class="card-body">
                                <p>{{ __('Bạn cần hoàn thành các bước theo hướng dẫn.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe('{{ config('services.stripe.key') }}');

            stripe.confirmCardPayment("{{ $clientSecret }}")
                .then(function(result) {
                    if (result.error) {
                        if (result.error.payment_intent && result.error.payment_intent.status === "requires_action") {
                            // 3D Secure required → Use handleCardAction
                            stripe.handleCardAction("{{ $clientSecret }}").then(function(authResult) {
                                if (authResult.error) {
                                    window.location.replace("{{ route('cancelled') }}");
                                }else {
                                    console.log("Authentication successful, paymentIntent:", authResult.paymentIntent.id);
                                    window.location.replace("{{ route('approval') }}");
                                }
                            });
                        } else {
                            window.location.replace("{{ route('cancelled') }}");
                        }
                    } else {
                        console.log("Payment successful:", result.paymentIntent.id);
                        window.location.replace("{{ route('approval') }}");
                    }
                });
        </script>
    </body>
</html>
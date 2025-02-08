
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

            stripe.handleCardAction("{{ $clientSecret }}")
                .then(function(result) {
                    if (result.error) {
                        window.location.replace("{{ route('cancelled') }}");
                    } else {
                        window.location.replace("{{ route('approval') }}");
                    }
                });
        </script>
    </body>
</html>
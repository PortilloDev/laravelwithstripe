<div class="p-6">
    <label for="">Detalles de tarjeta:</label>
    <div id="cardElement"></div>
    <small class="text-base text-red-600" id="cardErrors" role="alert"></small>
    <input type="hidden" name="payment_method" id="paymentMethod">
</div>
@push('scripts')
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
    
        const stripe = Stripe('{{config('services.stripe.key') }}');
        const elements = stripe.elements({locale: 'es'});
        const cardElement = elements.create('card');

        cardElement.mount('#cardElement');

        </script>
        <script>
            const form = document.getElementById('paymentForm');
            const payButton = document.getElementById('payButton');

            payButton.addEventListener('click', async(e) => {
                e.preventDefault();
                const { paymentMethod, error} = await stripe.createPaymentMethod(
                    'card', cardElement, {
                        billing_details: {
                            "name" : "{{ auth()->user()->name}}",
                            "email" : "{{ auth()->user()->email}}",
                        }
                    }
                );

                if (error) {
                    const displayError = document.getElementById('cardErrors');
                    displayError.textContent = error.message;
                } else {
                    const token = document.getElementById('paymentMethod');
                    token.value = paymentMethod.id;
                    form.submit();
                }
            });
        </script>
@endpush
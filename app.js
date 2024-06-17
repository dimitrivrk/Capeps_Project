let stripe = Stripe('pk_test_51PQWT6RvBURxGjZoahbJizpshduM2Jsy25HEv1pG2JRjIx07UIuIFiDHuTyKD5IlhPZyCznBCZY0A8wMOChV97qJ002eJg6PhD')

let elements = stripe.elements()

let card = elements.create('card');
card.mount('#card-element');

card.addEventListener('change', function(event) {
    let displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

let form = document.querySelector("#payment-form");
form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            let errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    let form = document.querySelector('#payment-form');
    let hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    form.submit();
}

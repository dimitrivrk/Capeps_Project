let cart = JSON.parse(localStorage.getItem('cart')) || [];
console.log(cart);

function addToCart(id, price) {
    if (!cart.some(item => item.id === id)) {
        cart.push({id, price});
        localStorage.setItem('cart', JSON.stringify(cart));
        alert("Produit ajouté au panier");
    } else {
        alert("Ce produit est déjà dans le panier");
    }
    updateCartCount();
}

function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
    updateCartCount();
}

function clearCart() {
    cart = [];
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
    updateCartCount();
}

function renderCart() {
    let cartDiv = document.getElementById('cart');
    if (cartDiv) {
        console.log(cartDiv);

        if (cart.length > 0) {
            let total = cart.reduce((sum, item) => sum + item.price, 0);
            cartDiv.innerHTML = cart.map(item => 
                `<p>${item.id} - ${item.price}€ <button onclick="removeFromCart('${item.id}')">Retirer</button></p>`
            ).join('') + `<p>Total: ${total}€</p>`;
        } else {
            cartDiv.innerHTML = '<p>Votre panier est vide.</p>';
        }
    }
}

function renderCartDetails() {
    let cartDetailsDiv = document.getElementById('cart-details');
    if (cartDetailsDiv) {
        if (cart.length > 0) {
            let total = cart.reduce((sum, item) => sum + item.price, 0);
            cartDetailsDiv.innerHTML = cart.map(item => 
                `<p>${item.id} - ${item.price}€</p>`
            ).join('') + `<p>Total: ${total}€</p>`;
        } else {
            cartDetailsDiv.innerHTML = '<p>Votre panier est vide.</p>';
        }
    }
}

function updateCartCount() {
    let cartCount = cart.length;
    document.getElementById('cart-count').innerText = cartCount;
}

document.addEventListener('DOMContentLoaded', function() {
    let stripe = Stripe('pk_test_51PQWT6RvBURxGjZoahbJizpshduM2Jsy25HEv1pG2JRjIx07UIuIFiDHuTyKD5IlhPZyCznBCZY0A8wMOChV97qJ002eJg6PhD');
    let elements = stripe.elements();
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

    let form = document.querySelector('#payment-form');
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

        let cartInput = document.createElement('input');
        cartInput.setAttribute('type', 'hidden');
        cartInput.setAttribute('name', 'cart');
        cartInput.setAttribute('value', JSON.stringify(cart));
        form.appendChild(cartInput);

        form.submit();
    }

    // Render the cart on page load
   
});

renderCart();
updateCartCount();

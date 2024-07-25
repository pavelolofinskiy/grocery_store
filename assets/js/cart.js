document.addEventListener('DOMContentLoaded', function() {
    var updateButtonsLeft = document.querySelectorAll('.update-quantity-left');
    var updateButtonsRight = document.querySelectorAll('.update-quantity-right');
    var quantityInputs = document.querySelectorAll('.quantity-input');
    var totalPriceElement = document.getElementById('total-price');
    var checkoutLink = document.getElementById('checkout-link');

    function updateQuantity(cartId, newQuantity) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/cart/update_quantity.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                totalPriceElement.textContent = response.totalPrice.toFixed(2);
                checkoutLink.href = '/cart/payment.php?totalPrice=' + response.totalPrice.toFixed(2);

                var cartItem = document.querySelector('.cart-item[data-id="' + cartId + '"]');
                var itemTotalElement = cartItem.querySelector('.cart-item-total');
                var itemPrice = parseFloat(cartItem.querySelector('.cart-price').textContent.replace('$', ''));
                var itemTotalPrice = itemPrice * newQuantity;
                itemTotalElement.textContent = '$' + itemTotalPrice.toFixed(2);
            }
        };
        xhr.send('cart_id=' + cartId + '&quantity=' + newQuantity);
    }

    updateButtonsLeft.forEach(function(button) {
        button.addEventListener('click', function() {
            var cartItem = this.closest('.cart-item');
            var cartId = cartItem.getAttribute('data-id');
            var quantityInput = cartItem.querySelector('.quantity-input');
            var currentQuantity = parseInt(quantityInput.value);

            if (currentQuantity > 1) {
                currentQuantity--;
                quantityInput.value = currentQuantity;
                updateQuantity(cartId, currentQuantity);
            }
        });
    });

    updateButtonsRight.forEach(function(button) {
        button.addEventListener('click', function() {
            var cartItem = this.closest('.cart-item');
            var cartId = cartItem.getAttribute('data-id');
            var quantityInput = cartItem.querySelector('.quantity-input');
            var currentQuantity = parseInt(quantityInput.value);

            currentQuantity++;
            quantityInput.value = currentQuantity;
            updateQuantity(cartId, currentQuantity);
        });
    });

    quantityInputs.forEach(function(input) {
        input.addEventListener('blur', function() {
            var cartItem = this.closest('.cart-item');
            var cartId = cartItem.getAttribute('data-id');
            var newQuantity = parseInt(this.value);
            if (newQuantity > 0) {
                updateQuantity(cartId, newQuantity);
            } else {
                this.value = 1;
                updateQuantity(cartId, 1);
            }
        });

        input.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                var cartItem = this.closest('.cart-item');
                var cartId = cartItem.getAttribute('data-id');
                var newQuantity = parseInt(this.value);
                if (newQuantity > 0) {
                    updateQuantity(cartId, newQuantity);
                } else {
                    this.value = 1;
                    updateQuantity(cartId, 1);
                }
            }
        });
    });

    var removeButtons = document.querySelectorAll('.remove-item');

    removeButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            var cartItem = this.closest('.cart-item');
            var cartItemId = cartItem.getAttribute('data-id');

            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/cart/remove.php?id=' + cartItemId, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        cartItem.classList.add('fade-out');
                        cartItem.addEventListener('animationend', function() {
                            cartItem.remove();
                            updateTotalPrice();
                        });
                    } else if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                }
            };
            xhr.send();
        });
    });

    function updateTotalPrice() {
        var totalPriceElement = document.getElementById('total-price');
        var cartItems = document.querySelectorAll('.cart-item');
        var totalPrice = 0;

        cartItems.forEach(function(cartItem) {
            var itemTotalElement = cartItem.querySelector('.cart-item-total');
            var itemTotalPrice = parseFloat(itemTotalElement.textContent.replace('$', ''));
            totalPrice += itemTotalPrice;
        });

        totalPriceElement.textContent = totalPrice.toFixed(2);
        var checkoutLink = document.getElementById('checkout-link');
        checkoutLink.href = '/cart/payment.php?totalPrice=' + totalPrice.toFixed(2);
    }
});
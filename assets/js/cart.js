document.addEventListener('DOMContentLoaded', function() {
  var cartButton = document.getElementById('cart-button');
  var cartPopup = document.getElementById('cart-popup');
  var closePopup = document.getElementById('close-popup');
  var overlayPopup = document.getElementById('overlayPopup');
  var refreshCartButton = document.getElementById('refresh-cart');
  var totalPriceElement = document.getElementById('total-price');
  var checkoutLink = document.getElementById('checkout-link');
  var totalProduct = document.getElementById('products-count');

  function openCartPopup() {
    fetch('/main/auth_check.php')
      .then(response => response.json())
      .then(data => {
        if (data.authenticated) {
          cartPopup.classList.add('show');
          overlayPopup.classList.add('show');
        } else {
          window.location.href = '/main/login.php';
        }
      })
      .catch(error => console.error('Error:', error));
  }


    

  function closeCartPopup() {
    overlayPopup.classList.remove('show');
    cartPopup.classList.add('fade-out');
    cartPopup.addEventListener('animationend', function handleAnimationEnd() {
      cartPopup.classList.remove('fade-out');
      cartPopup.classList.remove('show');
      cartPopup.removeEventListener('animationend', handleAnimationEnd);
    });
  }

  closePopup.addEventListener('click', function() {
    closeCartPopup();
  });

  window.addEventListener('click', function(event) {
    if (event.target === cartPopup) {
      closeCartPopup();
    }
  });

  // Function to initialize event listeners
  function initializeEventListeners() {
    var updateButtonsLeft = document.querySelectorAll('.update-quantity-left');
    var updateButtonsRight = document.querySelectorAll('.update-quantity-right');
    var quantityInputs = document.querySelectorAll('.quantity-input');
    var removeButtons = document.querySelectorAll('.remove-item');

    updateButtonsLeft.forEach(button => {
      button.addEventListener('click', function() {
        var cartItem = this.closest('.cart-item');
        var cartId = cartItem.getAttribute('data-id');
        var quantityInput = cartItem.querySelector('.quantity-input');
        var currentQuantity = parseInt(quantityInput.value, 10);

        if (currentQuantity > 1) {
          currentQuantity--;
          quantityInput.value = currentQuantity;
          updateQuantity(cartId, currentQuantity);
        }
      });
    });

    updateButtonsRight.forEach(button => {
      button.addEventListener('click', function() {
        var cartItem = this.closest('.cart-item');
        var cartId = cartItem.getAttribute('data-id');
        var quantityInput = cartItem.querySelector('.quantity-input');
        var currentQuantity = parseInt(quantityInput.value, 10);

        currentQuantity++;
        quantityInput.value = currentQuantity;
        updateQuantity(cartId, currentQuantity);
      });
    });

    quantityInputs.forEach(input => {
      input.addEventListener('blur', function() {
        var cartItem = this.closest('.cart-item');
        var cartId = cartItem.getAttribute('data-id');
        var newQuantity = parseInt(this.value, 10);
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
          var newQuantity = parseInt(this.value, 10);
          if (newQuantity > 0) {
            updateQuantity(cartId, newQuantity);
          } else {
            this.value = 1;
            updateQuantity(cartId, 1);
          }
        }
      });
    });

    removeButtons.forEach(button => {
      button.addEventListener('click', function(event) {
        event.preventDefault();

        var cartItem = this.closest('.cart-item');
        var cartItemId = cartItem.getAttribute('data-id');

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/cart/remove.php?id=' + encodeURIComponent(cartItemId), true);
        xhr.onload = function() {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              cartItem.classList.add('fade-out');
              cartItem.addEventListener('animationend', function() {
                cartItem.remove();
                updateTotalPrice();
                updateCartCount();
              });
            } else if (response.redirect) {
              window.location.href = response.redirect;
            }
          }
        };
        xhr.send();
      });
    });
  }

  // Function to update quantity
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

        updateCartCount();
      }
    };
    xhr.send('cart_id=' + encodeURIComponent(cartId) + '&quantity=' + encodeURIComponent(newQuantity));
  }

  // Function to update cart count
  function updateCartCount() {
    var totalProducts = 0;
    document.querySelectorAll('.quantity-input').forEach(function(input) {
      totalProducts += parseInt(input.value, 10);
    });
    totalProduct.textContent = totalProducts;
  }

  // Function to update total price
  function updateTotalPrice() {
    var cartItems = document.querySelectorAll('.cart-item');
    var totalPrice = 0;

    cartItems.forEach(function(cartItem) {
      var itemTotalElement = cartItem.querySelector('.cart-item-total');
      var itemTotalPrice = parseFloat(itemTotalElement.textContent.replace('$', ''));
      totalPrice += itemTotalPrice;
    });

    totalPriceElement.textContent = totalPrice.toFixed(2);
    checkoutLink.href = '/cart/payment.php?totalPrice=' + totalPrice.toFixed(2);
  }

  // Function to refresh cart
  function refreshCart() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/cart/get_cart.php', true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        var response = xhr.responseText;
        var cartPopupContent = document.getElementById('cart-items');
        cartPopupContent.innerHTML = response;
        initializeEventListeners();
        updateCartCount();
        updateTotalPrice();
      } else {
        alert('Error refreshing cart.');
      }
    };
    xhr.send();
  }

  if (refreshCartButton) {
    refreshCartButton.addEventListener('click', function() {
      refreshCart();
    });
  }

  // Initialize add-to-cart event listeners
  if (!window.addToCartScriptInitialized) {
    window.addToCartScriptInitialized = true;

    var addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        var productId = this.getAttribute('data-product-id');
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/cart/add_to_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              refreshCart();
              totalProduct.textContent = parseInt(totalProduct.textContent, 10) + 1;
              openCartPopup();
            } else {
              alert('Error adding product to cart.');
            }
          }
        };
        xhr.send('product_id=' + productId);
      });
    });
  }

  cartButton.addEventListener('click' , function() {
    refreshCart();
    openCartPopup();
  }) 

  // Initialize event listeners for the first time
  initializeEventListeners();
});
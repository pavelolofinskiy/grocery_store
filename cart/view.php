<?php
include __DIR__ . '/../includes/db.php';

session_start();

$userId = $_SESSION['user_id'];

$sql = "SELECT cart.id, products.name, products.price, cart.quantity, products.img_link
        FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll();

$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}

function formatPrice($price) {
    return number_format($price, 2);
}
?>

<link rel="stylesheet" href="/assets/css/cart.css">
<link href='https://unpkg.com/css.gg@2.0.0/icons/css/trash.css' rel='stylesheet'>

<div class="cart" id="cart-items">
    <div class="cart-items-wrapper">
        <?php foreach ($cartItems as $item): ?>
            <div class="cart-item" data-id="<?php echo $item['id']; ?>">
                <div class='first-row'>
                    <div class="cart-product-img">
                        <img src="<?php echo htmlspecialchars($item['img_link']); ?>" alt="Product Image">
                    </div>
                    <p class="product-name"><?php echo htmlspecialchars($item['name']); ?></p>
                    <a href="/cart/remove.php?id=<?php echo $item['id']; ?>" class="remove-item"><i class="fa-solid fa-trash-can"></i></i></a>
                </div>
                <div class='second-row'>
                    <div class="quantity">
                        <button class="update-quantity-left" data-action="decrement">-</button>
                        <input type="number" class="quantity-input" value="<?php echo $item['quantity']; ?>" min="1">
                        <button class="update-quantity-right" data-action="increment">+</button>
                    </div>
                    <div class="cart-product">
                        <p class="cart-item-total">$<?php echo formatPrice($item['price'] * $item['quantity']); ?></p>
                        <p class="cart-price">$<?php echo formatPrice($item['price']); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class='checkout'>
    <p><a href='/cart/payment.php?totalPrice=<?php echo $totalPrice; ?>'>Check Out</a></p>
    <p>Total Price: $<span id="total-price"><?php echo $totalPrice; ?></span></p>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var updateButtonsLeft = document.querySelectorAll('.update-quantity-left');
    var updateButtonsRight = document.querySelectorAll('.update-quantity-right');
    var quantityInputs = document.querySelectorAll('.quantity-input');

    function updateQuantity(cartId, newQuantity) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/cart/update_quantity.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById('total-price').textContent = response.totalPrice.toFixed(2);

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
});
</script>
</body>
</html>
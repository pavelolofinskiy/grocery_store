<?php
include __DIR__ . '/../includes/db.php';

$userId = $_SESSION['user_id'];

$sql = "SELECT cart.id, products.name, products.price, cart.quantity
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
$totalPrice = number_format($totalPrice, 2); 

function formatPrice($price) {
    return number_format($price, 2);
}
?>

<h2>Your Cart</h2>
<div class="cart" id="cart-items">
    <?php foreach ($cartItems as $item): ?>
        <div class="cart-item" data-id="<?php echo $item['id']; ?>">
            <h3><?php echo $item['name']; ?></h3>
            <p>Price: $<?php echo formatPrice($item['price']); ?></p>  <!-- Format item price -->
            <p>Quantity: 
                <button class="update-quantity" data-action="decrement">-</button>
                <input type="number" class="quantity-input" value="<?php echo $item['quantity']; ?>" min="1">
                <button class="update-quantity" data-action="increment">+</button>
            </p>
            <a href="/cart/remove.php?id=<?php echo $item['id']; ?>">Remove</a>
        </div>
    <?php endforeach; ?>
</div>
<button onclick="history.back()">Back</button>
<p><a href='/cart/payment.php'>Purchase</a></p>

<p>Total Price: $<span id="total-price"><?php echo $totalPrice; ?></span></p>  <!-- Display formatted total price -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var updateButtons = document.querySelectorAll('.update-quantity');
        var quantityInputs = document.querySelectorAll('.quantity-input');

        function updateQuantity(cartId, newQuantity) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/cart/update_quantity.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById('total-price').textContent = response.totalPrice.toFixed(2);  
                }
            };
            xhr.send('cart_id=' + cartId + '&quantity=' + newQuantity);
        }

        updateButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var action = this.getAttribute('data-action');
                var cartItem = this.closest('.cart-item');
                var cartId = cartItem.getAttribute('data-id');
                var quantityInput = cartItem.querySelector('.quantity-input');
                var currentQuantity = parseInt(quantityInput.value);

                if (action === 'increment') {
                    currentQuantity++;
                } else if (action === 'decrement' && currentQuantity > 1) {
                    currentQuantity--;
                }

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
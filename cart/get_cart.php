<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

include __DIR__ . '/../includes/db.php';

$userId = $_SESSION['user_id'];

$sql = "SELECT cart.id, products.name, products.price, cart.quantity, products.img_link
        FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll();

$totalPrice = 0;
$totalProducts = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
    $totalProducts += $item['quantity'];
}

function formatPrice($price) {
    return number_format($price, 2);
}

ob_start();
?>

<div class="cart-items-wrapper" id="cart-items">
    <?php foreach ($cartItems as $item): ?>
        <div class="cart-item" data-id="<?php echo $item['id']; ?>">
            <div class='first-row'>
                <div class="cart-product-img">
                    <img src="<?php echo htmlspecialchars($item['img_link']); ?>" alt="Product Image">
                </div>
                <p class="product-name"><?php echo htmlspecialchars($item['name']); ?></p>
                <a href="#" class="remove-item"><i class="fa-solid fa-trash-can"></i></a>
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


<?php
$output = ob_get_clean();
echo $output;
?>
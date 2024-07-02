<?php
include '../includes/db.php';
include '../includes/header.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$sql = "SELECT cart.id, products.name, products.price, cart.quantity
        FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll();
?>

<h2>Your Cart</h2>
<div class="cart">
    <?php foreach ($cartItems as $item): ?>
        <div class="cart-item">
            <h3><?php echo $item['name']; ?></h3>
            <p>Price: <?php echo $item['price']; ?></p>
            <p>Quantity: <?php echo $item['quantity']; ?></p>
            <a href="/cart/remove.php?id=<?php echo $item['id']; ?>">Remove</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include '../includes/footer.php'; ?>
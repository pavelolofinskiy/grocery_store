<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic HTML Script</title>
    <link rel="stylesheet" href="assets\css\main.css">
</head>

<?php


include '../includes/db.php';
include '../includes/header.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php');
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

$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}
?>

<h2>Your Cart</h2>
<div class="cart">
    <?php foreach ($cartItems as $item): ?>
        <div class="cart-item">
            <h3><?php echo $item['name']; ?></h3>
            <p>Price: $<?php echo $item['price']; ?></p>
            <p>Quantity: <?php echo $item['quantity']; ?></p>
            <a href="/cart/remove.php?id=<?php echo $item['id']; ?>">Remove</a>
            <p><?php 

            ?></p>
        </div>
    <?php endforeach; ?>
</div>
<button onclick="history.back()">Back</button>
<p><a href='/cart/payment.php'>Purchcase</a></p>

<p>Total Price: <?php echo $totalPrice; ?></p>

<?php include '../includes/footer.php'; ?>
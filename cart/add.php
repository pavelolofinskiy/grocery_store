<?php
include __DIR__ . '/../includes/db.php';
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if (!isset($_SESSION['user_id'])) {
    echo 'Please log in first';
    exit;
}

$userId = $_SESSION['user_id'];
$productId = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Validate quantity
if ($quantity < 1 || $quantity > 20) {
    echo 'Invalid quantity';
    exit;
}

$sql_check = "SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?";
$stmt_check = $pdo->prepare($sql_check);
$stmt_check->execute([$userId, $productId]);
$cartItem = $stmt_check->fetch();

if ($cartItem) {
    $newQuantity = $cartItem['quantity'] + $quantity;
    $sql_update = "UPDATE cart SET quantity = ? WHERE id = ?";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute([$newQuantity, $cartItem['id']]);
} else {
    $sql_insert = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->execute([$userId, $productId, $quantity]);
}

// Return the updated cart item count (or other response as needed)
$sql_count = "SELECT SUM(quantity) as total FROM cart WHERE user_id = ?";
$stmt_count = $pdo->prepare($sql_count);
$stmt_count->execute([$userId]);
$cartTotal = $stmt_count->fetchColumn();

echo $cartTotal;
?>
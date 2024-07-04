<?php
include '../includes/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$productId = $_GET['id'];

$sql_check = "SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?";
$stmt_check = $pdo->prepare($sql_check);
$stmt_check->execute([$userId, $productId]);
$cartItem = $stmt_check->fetch();

if ($cartItem) {
    $sql_update = "UPDATE cart SET quantity = quantity + 1 WHERE id = ?";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute([$cartItem['id']]);
} else {
    $sql_insert = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)";
    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->execute([$userId, $productId]);
}

header('Location: ../cart/view.php');
exit;
?>
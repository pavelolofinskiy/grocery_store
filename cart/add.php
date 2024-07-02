<?php
include '../includes/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$productId = $_GET['id'];

$sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)
        ON DUPLICATE KEY UPDATE quantity = quantity + 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId, $productId]);

header('Location: ../cart/view.php');
?>
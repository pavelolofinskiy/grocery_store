<?php
include __DIR__ . '/../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /main/login.php');
    exit;
}

$cartItemId = $_GET['id'];

$sql = "DELETE FROM cart WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$cartItemId]);

header('Location: view.php');
?>
<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$cartItemId = $_GET['id'];

$sql = "DELETE FROM cart WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$cartItemId]);

header('Location: view.php');
?>
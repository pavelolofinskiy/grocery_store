<?php
include __DIR__ . '/../includes/db.php';
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['redirect' => '/main/login.php']);
    exit;
}

$cartItemId = $_GET['id'];

$sql = "DELETE FROM cart WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$cartItemId]);

echo json_encode(['success' => true]);
?>
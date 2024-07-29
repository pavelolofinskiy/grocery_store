<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

    $userId = $_SESSION['user_id'];

    if ($productId > 0) {

        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1) 
                ON DUPLICATE KEY UPDATE quantity = quantity + 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId, $productId]);

        $sql = "SELECT COUNT(*) FROM cart WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);
        $cartCount = $stmt->fetchColumn();

        echo json_encode(['success' => true, 'cartCount' => $cartCount]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
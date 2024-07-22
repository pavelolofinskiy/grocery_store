<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart_id']) && isset($_POST['quantity'])) {
    $cartId = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$quantity, $cartId, $userId]);

    $sql = "SELECT cart.id, products.price, cart.quantity
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

    echo json_encode(['totalPrice' => $totalPrice]);
}
?>
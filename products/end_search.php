<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\css\main.css">
    <link rel="stylesheet" href="assets\css\header.css">
</head>

<?php
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/db.php';

$product_name = $_GET['item_name'];

$sql = "SELECT * FROM products WHERE name LIKE ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(['%' . $product_name . '%']);
$obj_array = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="cart">
    <div class="cart-item">
        <?php foreach ($obj_array as $product): ?>
            <h3><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
            <p><?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Price: $<?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Created At: <?php echo htmlspecialchars($product['created_at'], ENT_QUOTES, 'UTF-8'); ?></p>
            <form action="/cart/add.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" max="20" value="1">
                <button type="submit">Add to Cart</button>
            </form>
        <?php endforeach; ?>
    </div>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
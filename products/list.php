<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets\css\main.css">
</head>

<?php
include '../includes/header.php';
include '../includes/db.php';


$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();
?>

<h2>Products</h2>
<div class="products">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo $product['description']; ?></p>
            <p>Price: <?php echo $product['price']; ?></p>
            <a href="/products/product_view.php?id=<?php echo $product['id']; ?>">View Product</a>
            <a href="/cart/add.php?id=<?php echo $product['id']; ?>">Add to Cart</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include '../includes/footer.php'; ?>
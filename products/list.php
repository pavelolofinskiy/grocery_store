<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/cart_popup.css">
</head>

<?php
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/db.php';


$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();
?>

<h2>Products</h2>
<div class="products">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <img src=<?php echo $product['img_link'];?> >
            <h3><?php echo $product['name']; ?></h3>
            <p>Price: $<?php echo $product['price']; ?></p>
            <a href="/products/product_view.php?id=<?php echo $product['id']; ?>">View Product</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
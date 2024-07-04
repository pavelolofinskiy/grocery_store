<?php
include '../includes/db.php';

$productId = $_GET['id'];

$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$productId]);
$product = $stmt->fetch();

if ($product):
?>

<div class="cart">
    <div class="cart-item">
        <h3><?php echo $product['name']; ?></h3>
        <p><?php echo $product['description']; ?></p>
        <p>Price: <?php echo $product['price']; ?></p>
        <p>Created At: <?php echo $product['created_at']; ?></p>
    </div>
</div>

<?php
else:
    echo "Product not found.";
endif;
?>
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
            <a href="/cart/add.php?id=<?php echo $product['id']; ?>">Add to Cart</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include '../includes/footer.php'; ?>
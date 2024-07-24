<?php
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/db.php';

$productId = $_GET['id'];

$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$productId]);
$product = $stmt->fetch();

if ($product):
?>
<link rel="stylesheet" href="/assets/css/cart_popup.css">
<link rel="stylesheet" href="/assets/css/product_view.css">
<div class="product">
    <div class="product-item">
        <h3><?php echo $product['name']; ?></h3>
        <p><?php echo $product['description']; ?></p>
        <p>Price: $<?php echo $product['price']; ?></p>
        <p>Created At: <?php echo $product['created_at']; ?></p>
        <form action="/cart/add.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" max="20" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</div>
<button onclick="history.back()">Back to products</button>

<?php
else:
    echo "Product not found.";
endif;

include __DIR__ . '/../includes/footer.php';
?>


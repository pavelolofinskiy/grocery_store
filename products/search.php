<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\css\main.css">
    <link rel="stylesheet" href="assets\css\header.css">
</head>

<?php
include '../includes/header.php';
include '../includes/db.php';

$product_name = $_GET['item_name'];


$sql = "SELECT * FROM products WHERE name LIKE '%$product_name%'";
$smtm = $pdo->query($sql);
$obj_array = $smtm->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="cart">
    <div class="cart-item">
        <?php foreach ($pdo->query($sql) as $product): ?>
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
        <?php endforeach; ?>
    </div>
</div>


<?php
include '../includes/footer.php';
?>

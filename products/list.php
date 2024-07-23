<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/cart_popup.css">
    <link rel="stylesheet" href="/assets/css/products.css">
</head>
<body>

<?php
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/db.php';

$products_per_page = 8;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$offset = ($page - 1) * $products_per_page;

$total_products_sql = "SELECT COUNT(*) FROM products";
$total_products_stmt = $pdo->query($total_products_sql);
$total_products = $total_products_stmt->fetchColumn();
$total_pages = ceil($total_products / $products_per_page);

$sql = "SELECT * FROM products LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':limit', $products_per_page, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll();
?>

<section class="list-grid-section">
    <p class="list-general-grid-p">All Products</p>
    <div class="list-product-grid">
        <?php foreach ($products as $product): ?>
            <a href="products/product_view.php?id=<?php echo $product['id']; ?>" class="list-product-card-link">
                <div class="list-product-card">
                    <img src="<?php echo $product['img_link']; ?>" alt="<?php echo $product['name']; ?>">
                    <p class="list-product-p"><?php echo $product['name']; ?></p>
                    <div class="list-price-div">
                        <p class="list-price">$<?php echo $product['price']; ?> <span class="list-original-price">$<?php echo number_format($product['price'] * 1.1, 2); ?></span></p>
                        <button><i class="fa-solid fa-cart-shopping"></i>Add</button>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>" class="prev">&laquo; Previous</a>
    <?php endif; ?>
    
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?php echo $i; ?>" class="page-number"><?php echo $i; ?></a>
    <?php endfor; ?>
    
    <?php if ($page < $total_pages): ?>
        <a href="?page=<?php echo $page + 1; ?>" class="next">Next &raquo;</a>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
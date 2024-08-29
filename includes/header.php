<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/cart_popup.css">
    <script src="https://kit.fontawesome.com/71ee91ecc9.js" crossorigin="anonymous"></script>
</head>

<?php 
include __DIR__ . '/../includes/db.php';

if(!isset($_SESSION)) 
{ 
    session_start(); 
}     

$userId = $_SESSION['user_id'];


$sql = "SELECT cart.id, products.name, products.price, cart.quantity, products.img_link
        FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll();

$totalProducts = 0;
foreach ($cartItems as $item) {
    $totalProducts += $item['quantity'];
}

?>
<link rel="stylesheet" href="/assets/css/cart.css">
<body>
    <div class="overlay" id='overlay'></div>
    <div class="overlayPopup" id='overlayPopup'></div>
    <header class="header-section">
        <div class='header-shadow'>
            <div class="header-container">
                <div class="logo-menu">
                    <img src="/assets/img/div.cr-category-toggle.png" alt="Menu">
                </div>
                <nav class="main-nav">
                    <ul>
                        <li><a href="/main/index.php">Home</a></li>
                        <li><a href="/">Category</a></li>
                        <li><a href="/products/list.php">Products</a></li>
                        <li><a href="/">Pages</a></li>
                        <li><a href="/">Elements</a></li>
                    </ul>
                </nav>
                <div class="contact-info">
                    <span>+123 ( 456 ) ( 7890 )</span>
                </div>
            </div>
        </div>
        <div class='search-container'>
            <img src="/assets/img/logo.png" alt="FoodTrove Logo" class="logo">
            <img src="/assets/img/logo2.png" alt="FoodTrove Logo" class="logo2">
            <form autocomplete="off" class="input-form" action="/products/end_search.php" method="GET">
                <input type="text" id='item_name' name='item_name' placeholder="Search for items...">
                <button>
                    <i class="fas fa-search"></i>
                </button>
                <div class='results' id="results"></div>
            </form>
            <div class="user-actions">
                <img class='img2' src='/assets/img/account.png'>
                <a href="../main/login.php">Account</a>
                <img class='img3' src='/assets/img/cart.png'>
                <button class="cart-button" id="cart-button">Cart</button>
                <p class='products-count'id='products-count'><?php echo $totalProducts; ?></p>
            </div>
            <div class="logo-menu2">
                <img src="/assets/img/div.cr-category-toggle.png" alt="Menu">
            </div>
        </div>
    </header>
    <div id="cart-popup" class="popup">
        <div class="popup-content" id="popup-content">
            <span class="close" id="close-popup">&times;</span>
            <?php include __DIR__ . '/../cart/get_cart.php'; ?>
            <p><a href='/cart/payment.php?totalPrice=<?php echo $totalPrice; ?>' id="checkout-link">Check Out</a></p>
            <p>Total Price: $<span id="total-price"><?php echo formatPrice($totalPrice); ?></span></p>
            <button id="refresh-cart" class="refresh-cart-button">Refresh Cart</button>
        </div>
    </div>

    <script src='/assets/js/script.js'></script>
    <script src='/assets/js/cart.js'></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/css/header.css">
    <script src="https://kit.fontawesome.com/71ee91ecc9.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header-section">
        <div class='header-shadow'>
            <div class="header-container">
                <div class="logo-menu">
                    <img src="/assets/img/div.cr-category-toggle.png" alt="Menu">
                </div>
                <nav class="main-nav">
                    <ul>
                        <li><a href="/">Home</a></li>
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
                <a href="/account">Account</a>
                <img class='img3' src='/assets/img/cart.png'>
                <a href="/cart/view.php">Cart</a>
            </div>
            <div class="logo-menu2">
                    <img src="/assets/img/div.cr-category-toggle.png" alt="Menu">
            </div>
        </div>
    </header>

    <script src='/assets/js/script.js'></script>
</body>
</html>
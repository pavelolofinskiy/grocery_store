<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Trove</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/hero.css">
    <link rel="stylesheet" href="/assets/css/second-section.css">
    <link rel="stylesheet" href="/assets/css/third-section.css">
    <link rel="stylesheet" href="/assets/css/fourth-section.css">
    <link rel="stylesheet" href="/assets/css/fifth-section.css">
    <link rel="stylesheet" href="/assets/css/cart_popup.css">
    <link rel="stylesheet" type="/text/css" href="/assets/css/footer.css">
    <script src="https://kit.fontawesome.com/71ee91ecc9.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include __DIR__ . '/../includes/header.php';  ?>



<main>
    <div class='div-fix'></div>
    <div class='text'>
        <div class='text-div'>
            <div class='first-text'>
             <p class='first-text-percent'>100%</p>
             <p class='first-text-second'>Organic Vegetables</p>
            </div>
            <p class='general-text'>The best way to <br>
            stuff your wallet.</p>
            <p class='second-text'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet<br>
            reiciendis beatae consequuntur.</p>
            <a class='button'>Shop now</a>
        </div>
        <div>
            <img src="/assets/img/hero-item.png"> 
        </div>
    </div>
</main>

<section class="second-section">
    <div class='banners'>
        <div class='first-banner'>
            <img src='/assets/img/banner-1.png'>
            <p class='first-p'>Everyday Fresh &<br>
            Clean with Our<br>
            Products</p>
            <a class='second-button'>Shop now</a>
        </div>
        <div class='second-banner'>
            <img src='/assets/img/banner-2.png'>
            <p class='first-p'>Make your Breakfast<br>
            Healthy and Easy</p>
            <a class='second-button'>Shop now</a>
        </div>
        <div class='third-banner'>
            <img src='/assets/img/banner-3.png'>
            <p class='first-p'>The best Organic<br>
            Products Online</p>
            <a class='second-button'>Shop now</a>
        </div>
    </div>
</section>



<section class='grid-section'>
    <p class='general-grid-p'>Popular Products</p>
    <div class="product-grid">
        <a href="products/product_view.php?id=7" class="product-card-link">
            <div class="product-card">
                <img src="/assets/img/lemon.png" alt="Fresh organic villa farm lemon 500gm pack">
                <p class='product-p'>Fresh organic villa farm lemon 500gm pack</p>
                <div class='price-div'>
                    <p class="price">$28.85 <span class="original-price">$32.50</span></p>
                    <button><i class="fa-solid fa-cart-shopping"></i>Add</button>
                </div>
            </div>
        </a>
        <a href="/cart/add.php?id=124" class="product-card-link">
            <div class="product-card">
                <img src="/assets/img/hazelnut.png" alt="Best snacks with hazel nut pack 200gm">
                <p class='product-p'>Best snacks with hazel nut pack 200gm</p>
                <div class='price-div'>
                    <p class="price">$52.85 <span class="original-price">$59.99</span></p>
                    <button><i class="fa-solid fa-cart-shopping"></i>Add</button>
                </div>
            </div>
        </a>
        <a href="/cart/add.php?id=125" class="product-card-link">
            <div class="product-card">
                <img src="/assets/img/watermelon.png" alt="Organic fresh venilla farm watermelon 5kg">
                <p class='product-p'>Organic fresh venilla farm watermelon 5kg</p>
                <div class='price-div'>
                    <p class="price">$48.85 <span class="original-price">$50.00</span></p>
                    <button><i class="fa-solid fa-cart-shopping"></i>Add</button>
                </div>
            </div>
        </a>
        <a href="/cart/add.php?id=126" class="product-card-link">
            <div class="product-card">
                <img src="/assets/img/apple.png" alt="Fresh organic apple 1kg simla marming">
                <p class='product-p'>Fresh organic apple 1kg simla marming</p>
                <div class='price-div'>
                    <p class="price">$17.85 <span class="original-price">$20.00</span></p>
                    <button><i class="fa-solid fa-cart-shopping"></i>Add</button>
                </div>
            </div>
        </a>
        <a href="/cart/add.php?id=127" class="product-card-link">
            <div class="product-card">
                <img src="/assets/img/cereal.png" alt="Blue Diamond Almonds Lightly Salted Vegetables">
                <p class='product-p'>Blue Diamond Almonds Lightly Salted Vegetables</p>
                <div class='price-div'>
                    <p class="price">$23.85 <span class="original-price">$25.00</span></p>
                    <button><i class="fa-solid fa-cart-shopping"></i>Add</button>
                </div>
            </div>
        </a>
        <a href="/cart/add.php?id=128" class="product-card-link">
            <div class="product-card">
                <img src="/assets/img/yogurt.png" alt="Chobani Complete Vanilla Greek Yogurt">
                <p class='product-p'>Chobani Complete Vanilla Greek Yogurt</p>
                <div class='price-div'>
                    <p class="price">$54.85 <span class="original-price">$60.00</span></p>
                    <button><i class="fa-solid fa-cart-shopping"></i>Add</button>
                </div>
            </div>
        </a>
        <a href="/cart/add.php?id=129" class="product-card-link">
            <div class="product-card">
                <img src="/assets/img/pistachio.png" alt="Canada Dry Ginger Ale - 2L Bottle - 200ml - 400g">
                <p class='product-p'>Canada Dry Ginger Ale - 2L Bottle - 200ml - 400g</p>
                <div class='price-div'>
                    <p class="price">$32.85 <span class="original-price">$35.00</span></p>
                    <button><i class="fa-solid fa-cart-shopping"></i>Add</button>
                </div>
            </div>
        </a>
        <a href="/cart/add.php?id=130" class="product-card-link">
            <div class="product-card">
                <img src="/assets/img/salmon.png" alt="Encore Seafoods Stuffed Alaskan Salmon">
                <p class='product-p'>Encore Seafoods Stuffed Alaskan Salmon</p>
                <div class='price-div'>
                    <p class="price">$35.85 <span class="original-price">$40.00</span></p>
                    <button><i class="fa-solid fa-cart-shopping"></i>Add</button>
                </div>
            </div>
        </a>
        <a href="/cart/add.php?id=131" class="product-card-link">
            <div class="product-card">
                <img src="/assets/img/icecream.png" alt="Haagen-Dazs Caramel Cone Ice Cream Ketchup">
                <p class='product-p'>Haagen-Dazs Caramel Cone Ice Cream Ketchup</p>
                <div class='price-div'>
                    <p class="price">$22.85 <span class="original-price">$25.00</span></p>
                    <button><i class="fa-solid fa-cart-shopping"></i>Add</button>
                </div>
            </div>
        </a>
        <a href="/cart/add.php?id=132" class="product-card-link">
            <div class="product-card">
                <img src="/assets/img/coffee.png" alt="Cafe Altura Organic Coffee - Light Roast">
                <p class='product-p'>Cafe Altura Organic Coffee - Light Roast</p>
                <div class='price-div'>
                    <p class="price">$23.85 <span class="original-price">$28.00</span></p>
                    <button><i class="fa-solid fa-cart-shopping"></i>Add</button>
                </div>
            </div>
        </a>
    </div>
</section>
<section>
    <div class="best-sells">
        <p class='best-sells-p'>Daily Best Sells</p>
        <div class="grid-container">
            <div class="fixed-item">
                <img src="/assets/img/image.png" alt="Nature Image">
                <div class="text-overlay">
                    <p>Bring nature into your home</p>
                    <button>Shop Now</button>
                </div>
            </div>
            <div class="second-product-card">
                <img src="/assets/img/coconut.png" alt="Coconut Flakes">
                <p class='cart-name'>All Natural Italian-Style Chicken Meatballs</p>
                <p class="price">$238.85 <span class="original-price">$245.8</span></p> 
                <div class='progress-container'>
                    <div class="progress-bar"></div>
                </div>
                <p class="sold">Sold: 90/120</p>
                <button>Add To Cart</button>
            </div>
            <div class="second-product-card">
                <img src="/assets/img/snacks.png" alt="Snacks">
                <p class='cart-name'>Angie's Boomchickapop Sweet and Wommies</p>
                <p class="price">$238.85 <span class="original-price">$245.8</span></p>
                <div class='progress-container'>
                    <div class="progress-bar"></div>
                </div>
                <p class="sold">Sold: 90/120</p>
                <button>Add To Cart</button>
            </div>
            <div class="second-product-card">
                <img src="/assets/img/veggies.png" alt="Veggie Pops">
                <p class='cart-name'>Foster Farms Takeout Crispy Classic</p>
                <p class="price">$238.85 <span class="original-price">$245.8</span></p>
                <div class='progress-container'>
                    <div class="progress-bar"></div>
                </div>
                <p class="sold">Sold: 90/120</p>
                <button>Add To Cart</button>
            </div>
            <div class="second-product-card">
                <img src="/assets/img/almonds.png" alt="Almonds">
                <p class='cart-name'>Blue Diamond Almonds Lightly Salted</p>
                <p class="price">$238.85 <span class="original-price">$245.8</span></p>
                <div class='progress-container'>
                    <div class="progress-bar"></div>
                </div>
                <p class="sold">Sold: 90/120</p>
                <button>Add To Cart</button>
            </div>
        </div>
    </div>
</section>

<section>
    <div class='background'>
        <div>
            <p class='background-general-p'>Stay home & get your daily<br>
            needs from our shop</p>
            <p class='background-second-p'>Start You'r Daily Shopping with Foodtrove</p>
            <form class="form-container">
                <input type="email" placeholder="Your email address" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
        <div>
            <img src="/assets/img/second-image.png"> 
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?> 
</body>
</html>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Trove</title>
    <link rel="stylesheet" href="assets\css\main.css">
    <link rel="stylesheet" href="assets\css\hero.css">
    <link rel="stylesheet" href="assets\css\second-section.css">
    <link rel="stylesheet" href="assets\css\third-section.css">
</head>
<body>
<?php
session_start();
?>

<main>
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
            <img src="assets/img/hero-item.png"> 
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

<section class="product-grid">
    <div class="product-card">
        <img src="/assets/img/lemon.png" alt="Fresh organic villa farm lemon 500gm pack">
        <p class='product-p'>Fresh organic villa farm lemon 500gm pack</p>
        <div class='price-div'>
        <p>$28.85</p>
        <button>Add</button>
        </div>
    </div>
    <div class="product-card">
        <img src="/assets/img/hazelnut.png" alt="Best snacks with hazel nut pack 200gm">
        <p class='product-p'>Best snacks with hazel nut pack 200gm</p>
        <div class='price-div'>
        <p>$52.85</p>
        <button>Add</button>
        </div>
    </div>
    <div class="product-card">
        <img src="/assets/img/watermelon.png" alt="Organic fresh venilla farm watermelon 5kg">
        <p class='product-p'>Organic fresh venilla farm watermelon 5kg</p>
        <div class='price-div'>
        <p>$48.85</p>
        <button>Add</button>
        </div>
    </div>
    <div class="product-card">
        <img src="/assets/img/apple.png" alt="Fresh organic apple 1kg simla marming">
        <p class='product-p'>Fresh organic apple 1kg simla marming</p>
        <div class='price-div'>
        <p>$17.85</p>
        <button>Add</button>
        </div>
    </div>
    <div class="product-card">
        <img src="/assets/img/cereal.png" alt="Blue Diamond Almonds Lightly Salted Vegetables">
        <p class='product-p'>Blue Diamond Almonds Lightly Salted Vegetables</p>
        <div class='price-div'>
        <p>$23.85</p>
        <button>Add</button>
        </div>
    </div>
    <div class="product-card">
        <img src="/assets/img/yogurt.png" alt="Chobani Complete Vanilla Greek Yogurt">
        <p class='product-p'>Chobani Complete Vanilla Greek Yogurt</p>
        <div class='price-div'>
        <p>$54.85</p>
        <button>Add</button>
        </div>
    </div>
    <div class="product-card">
        <img src="/assets/img/pistachio.png" alt="Canada Dry Ginger Ale - 2L Bottle - 200ml - 400g">
        <p class='product-p'>Canada Dry Ginger Ale - 2L Bottle - 200ml - 400g</p>
        <div class='price-div'>
        <p>$32.85</p>
        <button>Add</button>
        </div>
    </div>
    <div class="product-card">
        <img src="/assets/img/salmon.png" alt="Encore Seafoods Stuffed Alaskan Salmon">
        <p class='product-p'>Encore Seafoods Stuffed Alaskan Salmon</p>
        <div class='price-div'>
        <p>$35.85</p>
        <button>Add</button>
        </div>
    </div>
    <div class="product-card">
        <img src="/assets/img/icecream.png" alt="Haagen-Dazs Caramel Cone Ice Cream Ketchup">
        <p class='product-p'>Haagen-Dazs Caramel Cone Ice Cream Ketchup</p>
        <div class='price-div'>
        <p>$22.85</p>
        <button>Add</button>
        </div>
    </div>
    <div class="product-card">
        <img src="/assets/img/coffee.png" alt="Cafe Altura Organic Coffee - Light Roast">
        <p class='product-p'c>Cafe Altura Organic Coffee - Light Roast</p>
        <div class='price-div'>
        <p>$23.85</p>
        <button>Add</button>
        </div>
    </div>
</section>



</body>
</html>
<?php include 'includes/footer.php'; ?>

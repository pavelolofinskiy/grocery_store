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

<section>
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

</body>
</html>
<?php include 'includes/footer.php'; ?>

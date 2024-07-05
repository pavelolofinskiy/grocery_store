<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic HTML Script</title>
    <link rel="stylesheet" href="assets\css\main.css">
</head>
<body>
    <header>
        <h1>Welcome to My Website</h1>
    </header>
    <?php
session_start();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    echo "<p>Welcome, $username! <a href='logout.php'>Logout</a></p>";
} else {

    echo "<p>Welcome, Guest! <a href='login.php'>Login</a> or <a href='register.php'>Register</a></p>";
}
?>

<p><a href='products/list.php'>Products</a></p>


</body>
</html>
<?php include 'includes/footer.php'; ?>
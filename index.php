<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic HTML Script</title>

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
    <footer>
        <p>&copy; 2024 My Website</p>
    </footer>
</body>
</html>
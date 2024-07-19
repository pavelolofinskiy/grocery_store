<link rel="stylesheet" href="assets\css\login.css">

<?php
include 'includes/header.php';
include 'includes/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$identifier]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit(); 
    } else {
        echo '<p>Invalid email or password</p>';
    }
}
?>
<div class='info-div'>
    <div class='info-div-p'>
        <p>Login<p>
        <p></p>
        <p></p>   
    </div>
</div>
<section class='login-section'>
    <form class='login-form' action="login.php" method="post">
        <div class='login-logo-div'>
            <img src="/assets/img/logo.png" alt="FoodTrove Logo" class="logo">
        </div>
        <div class='login-email-div'>
            <label for="identifier">Email:</label>
            <input type="identifier" id="identifier" name="identifier" required>
        </div>
        <div class='login-password-div'>
            <label for="password">Password:</label> 
            <input type="password" id="password" name="password" required>
        </div>
        <div class='button-div'>
            <button type="submit">Login</button>
            <p><a href='/register.php'>Signup?</a></p>
        </div>
        
    </form>
</section>



<?php include 'includes/footer.php'; ?>
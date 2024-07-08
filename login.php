<?php
include 'includes/header.php';
include 'includes/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$identifier, $identifier]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit(); 
    } else {
        echo '<p>Invalid email or password</p>';
    }
}
?>

<h2>Login</h2>
<form action="login.php" method="post">
    <div>
        <label for="identifier">Email or username:</label>
        <input type="identifier" id="identifier" name="identifier" required>
    </div>
    <div>
        <label for="password">Password:</label> 
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Login</button>
</form>

<p><a href='/register.php'>Register</a></p>

<?php include 'includes/footer.php'; ?>
<?php
include 'includes/header.php';
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password !== $password2) {
        echo '<p>Passwords do not match</p>';
    } else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user) {
            echo '<p>User already exists</p>';
        } else {
            $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$email, $password])) {
                echo '<p>Registration successful! <a href="login.php">Login here</a></p>';
            } else {
                echo '<p>Registration failed</p>';
            }
        }
    }
}
?>

<h2>Register</h2>
<form action="register.php" method="post">
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="password">Confirm password:</label>
        <input type="password2" id="password2" name="password2" required>
    </div>
    <button type="submit">Register</button>
</form>
<p><a href='/login.php'>Login</a></p>

<?php include 'includes/footer.php'; ?>
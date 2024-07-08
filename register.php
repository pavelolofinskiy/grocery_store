<?php
include 'includes/header.php';
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $email]);
    $user = $stmt->fetch();

    if ($user) {
        echo '<p>Username or email already exists</p>';
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$username, $email, $password])) {
            echo '<p>Registration successful! <a href="login.php">Login here</a></p>';
        } else {
            echo '<p>Registration failed</p>';
        }
    }
}
?>

<h2>Register</h2>
<form action="register.php" method="post">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Register</button>
</form>
<p><a href='/login.php'>Login</a></p>

<?php include 'includes/footer.php'; ?>
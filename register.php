<?php
session_start();
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
                $_SESSION['user_id'] = $pdo->lastInsertId();
                header('Location: /index.php');
            } else {
                echo '<p>Registration failed</p>';
            }
        }
    }
}
?>

<h2>Register</h2>
<form id="registerForm" action="register.php" method="post">
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value='myemail@gmail.com' required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value='5504717AA' required>
    </div>
    <div>
        <label for="password2">Confirm password:</label>
        <input type="password" id="password2" name="password2" value='5504717AA'  required>
    </div>
    <button type="submit">Register</button>
    <p id="error-message" style="color: red;"></p>
</form>
<p><a href='/login.php'>Login</a></p>

<script>
document.getElementById('registerForm').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const password2 = document.getElementById('password2').value;
    const errorMessage = document.getElementById('error-message');

    if (password !== password2) {
        event.preventDefault();
        errorMessage.textContent = 'Passwords do not match';
    }
});
</script>

<?php include 'includes/footer.php'; ?>
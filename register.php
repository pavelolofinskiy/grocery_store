<?php
session_start();
include 'includes/db.php';


$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password !== $password2) {
        $response['error'] = 'Passwords do not match';
        echo json_encode($response);
        exit;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user) {
            $response['error'] = 'User already exists';
            echo json_encode($response);
            exit;
        } else {
            $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$email, $password])) {
                $_SESSION['user_id'] = $pdo->lastInsertId();
                $response['success'] = true;
                echo json_encode($response);
                exit;
            } else {
                $response['error'] = 'Registration failed';
                echo json_encode($response);
                exit;
            }
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<body>
    <h2>Register</h2>
    <form id="registerForm" action="" method="post">
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
            <input type="password" id="password2" name="password2" value='5504717AA' required>
        </div>
        <button type="submit">Register</button>
        <p id="error-message" style="color: red;"></p>
    </form>
    <p><a href='/login.php'>Login</a></p>

<script>
document.getElementById('registerForm').addEventListener('submit', function(event) {
event.preventDefault(); // Prevent the form from submitting the default way

const formData = new FormData(this);
const errorMessage = document.getElementById('error-message');

fetch('/register.php', {
    method: 'POST',
    body: formData
})
.then(response => response.json())
.then(data => {
    if (data.error) {
        errorMessage.textContent = data.error;
    } else if (data.success) {
        window.location.href = '/index.php'; // Redirect on successful registration
    }
})
.catch(error => {
    errorMessage.textContent = 'An error occurred';
});
});
</script>


</body>
</html>

<?php include 'includes/footer.php'; ?>
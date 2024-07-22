<?php
session_start();
include __DIR__ . '/../includes/db.php';


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

<?php include __DIR__ . '/../includes/header.php'; ?> 

<link rel="stylesheet" href="/assets/css/register.css">
<link rel="stylesheet" href="/assets/css/cart_popup.css">
<body>
    <div class='info-div'>
        <div class='info-div-p'>
            <p>Register</p>
            <p></p>
            <p></p>   
        </div>
    </div>
    <section class='register-section'>
        <form class='register-form' id="registerForm" action="" method="post">
            <div class='register-logo-div'>
                <img src="/assets/img/logo.png" alt="FoodTrove Logo" class="2logo">
            </div>
            <div class='register-email-div'>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value='myemail@gmail.com' required>
            </div>
            <div class='register-password-div'>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value='5504717AA' required>
            </div>
            <div class='register-password-div'>
                <label for="password2">Confirm password:</label>
                <input type="password" id="password2" name="password2" value='5504717AA' required>
            </div>
            <p id="error-message" class='error-message'></p>
            <div class='button-div'>
                <button type="submit">Register</button>
                <p><a href='/main/login.php'>Login</a></p>
            </div>
        </form>
    </section>

<script>
document.getElementById('registerForm').addEventListener('submit', function(event) {
event.preventDefault(); 

const formData = new FormData(this);
const errorMessage = document.getElementById('error-message');

fetch('/main/register.php', {
    method: 'POST',
    body: formData
})
.then(response => response.json())
.then(data => {
    if (data.error) {
        errorMessage.textContent = data.error;
    } else if (data.success) {
        window.location.href = '/main/index.php'; 
    }
})
.catch(error => {
    errorMessage.textContent = 'An error occurred';
});
});
</script>


</body>
</html>

<?php include __DIR__ . '/../includes/footer.php'; ?>
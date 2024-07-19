<?php
include 'includes/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    $response = []; // Initialize response array

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$identifier]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $response['success'] = true;
        echo json_encode($response);
        exit();
    } else {
        $response['error'] = 'Invalid email or password';
        echo json_encode($response);
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class='info-div'>
        <div class='info-div-p'>
            <p>Login</p>
            <p></p>
            <p></p>   
        </div>
    </div>
    <section class='login-section'>
        <form id="loginForm" class='login-form' action="login.php" method="post">
            <div class='login-logo-div'>
                <img src="/assets/img/logo.png" alt="FoodTrove Logo" class="logo">
            </div>
            <div class='login-email-div'>
                <label for="identifier">Email:</label>
                <input type="email" id="identifier" name="identifier" required>
            </div>
            <div class='login-password-div'>
                <label for="password">Password:</label> 
                <input type="password" id="password" name="password" required>
            </div>
            <p id="error-message" style="color: red;"></p>
            <div class='button-div'>
                <button type="submit">Login</button>
                <p><a href='/register.php'>Signup?</a></p>
            </div>
        </form>
    </section>
    <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const errorMessage = document.getElementById('error-message');

        fetch('login.php', { 
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                errorMessage.textContent = data.error;
            } else if (data.success) {
                window.location.href = '/index.php'; // Redirect on success
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            errorMessage.textContent = 'An error occurred. Please try again.';
        });
    });
    </script>
</body>
</html>

<?php include 'includes/footer.php'; ?>
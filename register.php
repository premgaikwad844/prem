<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        header("Location: register.php?error=password_mismatch");
        exit();
    }

    // Check if username already exists
    $check_sql = "SELECT id FROM users WHERE username = ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "s", $username);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        header("Location: register.php?error=username_exists");
        exit();
    }

    // Check if email already exists
    $check_email_sql = "SELECT id FROM users WHERE email = ?";
    $check_email_stmt = mysqli_prepare($conn, $check_email_sql);
    mysqli_stmt_bind_param($check_email_stmt, "s", $email);
    mysqli_stmt_execute($check_email_stmt);
    mysqli_stmt_store_result($check_email_stmt);

    if (mysqli_stmt_num_rows($check_email_stmt) > 0) {
        header("Location: register.php?error=email_exists");
        exit();
    }

    // Hash password and insert new user
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $insert_sql = "INSERT INTO users (username, email, mobile, password) VALUES (?, ?, ?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_sql);
    mysqli_stmt_bind_param($insert_stmt, "ssss", $username, $email, $mobile, $hashed_password);

    if (mysqli_stmt_execute($insert_stmt)) {
        header("Location: index.php?success=registered");
        exit();
    } else {
        header("Location: register.php?error=registration_failed");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <style>
    body {
        background-image: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .login-container {
        background-color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }
    .logo {
        text-align: center;
        margin-bottom: 2rem;
    }
    .logo img {
        width: 150px;
        height: auto;
        margin-bottom: 1rem;
    }
    .logo p {
        color: #666;
        margin: 5px 0 0 0;
        font-size: 1rem;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #333;
    }
    .form-group input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }
    .form-group input:focus {
        outline: none;
        border-color: #d93025;
        box-shadow: 0 0 0 2px rgba(217, 48, 37, 0.2);
    }
    button {
        width: 100%;
        padding: 0.75rem;
        background-color: #d93025;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    button:hover {
        background-color: #b31412;
    }
    .error {
        color: #d93025;
        text-align: center;
        margin-bottom: 1rem;
        padding: 0.5rem;
        background-color: #fce8e6;
        border-radius: 4px;
    }
    .success {
        color: #0f9d58;
        text-align: center;
        margin-bottom: 1rem;
        padding: 0.5rem;
        background-color: #e6f4ea;
        border-radius: 4px;
    }
    .register-link {
        text-align: center;
        margin-top: 1rem;
        color: #666;
    }
    .register-link a {
        color: #d93025;
        text-decoration: none;
    }
    .register-link a:hover {
        text-decoration: underline;
    }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="0ff5dde0-0cec-45f1-a45c-1fff08a5f082.jpeg" alt="Logo">
            <p>Join Our Community!</p>
        </div>
        <form action="register.php" method="POST" class="login-form">
            <h2>Create Account</h2>
            <?php
            if(isset($_GET['error'])) {
                if($_GET['error'] == 'password_mismatch') {
                    echo '<p class="error">Passwords do not match</p>';
                } elseif($_GET['error'] == 'username_exists') {
                    echo '<p class="error">Username already exists</p>';
                } elseif($_GET['error'] == 'email_exists') {
                    echo '<p class="error">Email already exists</p>';
                } elseif($_GET['error'] == 'registration_failed') {
                    echo '<p class="error">Registration failed. Please try again.</p>';
                }
            }
            ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" title="Please enter a valid 10-digit mobile number" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit">Register</button>
            <p class="register-link">Already have an account? <a href="index.php">Login here</a></p>
        </form>
    </div>
</body>
</html> 
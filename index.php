<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
            <p>Welcome Back!</p>
        </div>
        <form action="login.php" method="POST" class="login-form">
            <h2>Login</h2>
            <?php
            if(isset($_GET['error'])) {
                echo '<p class="error">Invalid username or password</p>';
            }
            if(isset($_GET['success']) && $_GET['success'] == 'registered') {
                echo '<p class="success">Registration successful! Please login.</p>';
            }
            ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>
</body>
</html> 
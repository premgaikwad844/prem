<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    .dashboard-container {
        background-color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
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
    .welcome-message {
        color: #333;
        margin-bottom: 2rem;
    }
    .button {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background-color: #d93025;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 1rem;
        transition: background-color 0.2s;
    }
    .button:hover {
        background-color: #b31412;
    }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="logo">
            <img src="0ff5dde0-0cec-45f1-a45c-1fff08a5f082.jpeg" alt="Logo">
        </div>
        <div class="welcome-message">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>You are now logged in.</p>
        </div>
        <a href="logout.php" class="button">Logout</a>
    </div>
</body>
</html>
 
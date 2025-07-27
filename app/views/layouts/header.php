<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth System</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .container { background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: red; margin-bottom: 15px; }
        .message { color: green; margin-bottom: 15px; }
        nav { margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #ddd; }
        nav a { margin-right: 15px; text-decoration: none; color: #333; }
        .vk-button { background-color: #4a76a8; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; display: inline-block; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="/dashboard">Dashboard</a>
                <a href="/protected">Protected Page</a>
                <a href="/logout">Logout</a>
            <?php else: ?>
                <a href="/">Home</a>
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            <?php endif; ?>
        </nav>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message"><?= $_SESSION['message'] ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
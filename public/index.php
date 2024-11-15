<?php
require_once '../includes/conn.php'; // Use your connection file
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Fetch messages from the database
$result = mysqli_query($con, "SELECT content FROM messages");
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anonymous Feed</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Anonymous Feed</h1>
        <div>
            <?php foreach ($messages as $message): ?>
                <div class="bg-white p-4 rounded shadow mb-2">
                    <?php if ($isLoggedIn): ?>
                        <p class="text-gray-800"><?= $message['content']; ?></p>
                    <?php else: ?>
                        <p class="blur-sm text-gray-500"><?= $message['content']; ?></p>
                        <p class="text-sm text-gray-400">Log in to view full content.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-4">
            <?php if ($isLoggedIn): ?>
                <a href="logout.php" class="text-blue-500 underline">Log Out</a>
            <?php else: ?>
                <a href="login.php" class="text-blue-500 underline">Log In</a>
                <a href="register.php" class="text-blue-500 underline ml-2">Register</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

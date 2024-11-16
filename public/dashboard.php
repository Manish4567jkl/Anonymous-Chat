<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "../includes/conn.php";

// Fetch unblurred messages
$query = "SELECT content FROM messages ORDER BY created_at DESC";
$result = mysqli_query($con, $query);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-6">Your Dashboard</h1>
        <p class="text-gray-600 mb-4">See all messages unblurred below:</p>
        <ul>
            <?php foreach ($messages as $msg): ?>
                <li class="bg-gray-200 p-3 mb-2 rounded">
                    <?php echo htmlspecialchars($msg['content']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="mt-8">
            <a href="post.php" class="text-blue-500 underline">Post a new message</a>.
        </div>
    </div>
</body>
</html>

<?php
session_start();
include "../includes/conn.php";

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Fetch messages from the database
$query = "SELECT id, content, user_id, created_at FROM messages ORDER BY created_at DESC";
$result = mysqli_query($con, $query);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Feed</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom blur effect for non-logged-in users */
        .blurred-content {
            filter: blur(5px);
            cursor: pointer;
        }

        /* Style to make the blurred content appear clickable */
        .clickable-blurred {
            cursor: pointer;
        }
    </style>
    <script>
        // Function to prompt user to log in when clicking on blurred content
        function promptLogin(event) {
            event.preventDefault(); // Prevent the default behavior of clicking (which is navigation)
            alert("Please log in to view this message.");
            window.location.href = 'login.php'; // Redirect to login page
        }
    </script>
</head>
<body class="bg-gray-900 text-white min-h-screen">

    <div class="max-w-4xl mx-auto p-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-purple-400">Message Feed</h1>

        <!-- Feed container -->
        <div class="space-y-6">
            <?php foreach ($messages as $msg): ?>
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700 transition hover:shadow-xl">
                    <!-- Username and timestamp -->
                    <div class="flex justify-between text-sm text-gray-400 mb-2">
                        <span class="font-semibold text-purple-300">Anonymous</span>
                        <span class="text-gray-500"><?php echo date("F j, Y, g:i a", strtotime($msg['created_at'])); ?></span>
                    </div>

                    <?php if ($isLoggedIn): ?>
                        <!-- Display unblurred content for logged-in users -->
                        <p class="text-lg text-white"><?php echo nl2br(htmlspecialchars($msg['content'])); ?></p>
                    <?php else: ?>
                        <!-- Apply blur effect and make content clickable for non-logged-in users -->
                        <p class="blurred-content clickable-blurred text-gray-500" onclick="promptLogin(event)">
                            <?php echo nl2br(htmlspecialchars($msg['content'])); ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-8">
            <a href="post.php" class="text-purple-400 text-lg font-semibold hover:underline">Post a new message</a>
        </div>
    </div>

</body>
</html>

<?php
session_start();
include "../includes/conn.php";


$isLoggedIn = isset($_SESSION['user_id']);

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
           
            .blurred-content {
                filter: blur(5px);
                cursor: pointer;
            }

           /
            .clickable-blurred {
                cursor: pointer;
            }
        </style>
        <script>
            
            function promptLogin(event) {
                event.preventDefault(); 
                alert("Please log in to view this message.");
                window.location.href = 'login.php'; 
            }
        </script>
    </head>
    <body class="bg-gray-900 text-white min-h-screen">

     
        <header class="bg-gray-800 p-4 shadow-md flex justify-between items-center">
            <h1 class="text-2xl font-bold text-purple-400">Message Feed</h1>
            <?php if ($isLoggedIn): ?>
                <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition">
                    Logout
                </a>
            <?php endif; ?>
        </header>

        <div class="max-w-4xl mx-auto p-8">
           
            <div class="text-center mb-8">
                <a href="post.php" class="text-purple-400 text-lg font-semibold hover:underline">Post a new message</a>
            </div>


            <div class="space-y-6">
                <?php foreach ($messages as $msg): ?>
                    <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700 transition hover:shadow-xl">
                        
                        <div class="flex justify-between text-sm text-gray-400 mb-2">
                            <span class="font-semibold text-purple-300">Anonymous</span>
                            <span class="text-gray-500"><?php echo date("j F, Y, g:i a", strtotime($msg['created_at'])); ?></span>
                        </div>

                        <?php if ($isLoggedIn): ?>
                             
                            <p class="text-lg text-white"><?php echo nl2br(htmlspecialchars($msg['content'])); ?></p>
                        <?php else: ?>
                            
                            <p class="blurred-content clickable-blurred text-gray-500" onclick="promptLogin(event)">
                                <?php echo nl2br(htmlspecialchars($msg['content'])); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </body>
</html>

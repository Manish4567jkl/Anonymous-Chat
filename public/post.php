<?php
// Start the session to track user login
session_start();
include "../includes/conn.php";

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Handle form submission for posting a message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = mysqli_real_escape_string($con, $_POST['message']);
    $user_id = $isLoggedIn ? $_SESSION['user_id'] : null;

    // Insert the message into the database
    $query = "INSERT INTO messages (user_id, content) VALUES (?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "is", $user_id, $content);
    mysqli_stmt_execute($stmt);

    // Redirect to prevent form resubmission
    header("Location: post.php?success=Message posted successfully!");
    exit();
}

// Fetch recent messages for display
$query = "SELECT content, user_id FROM messages ORDER BY created_at DESC";
$result = mysqli_query($con, $query);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Message</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8 max-w-lg bg-white shadow rounded">
        <h1 class="text-3xl font-bold mb-6">Post a Message</h1>
        
        <!-- Form for posting a new message -->
        <form method="POST" action="">
            <textarea name="message" required placeholder="Write your message here..." 
                      class="w-full h-24 p-3 border rounded mb-4"></textarea>
            <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600">
                Post Message
            </button>
        </form>

        <!-- Display recent messages -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Recent Messages</h2>
            <ul>
                <?php foreach ($messages as $msg): ?>
                    <li class="bg-gray-200 p-3 mb-2 rounded 
                        <?php echo $isLoggedIn ? '' : 'blur-sm'; ?> transition">
                        <?php 
                            // Show messages normally if logged in, otherwise show blurred content
                            echo htmlspecialchars($isLoggedIn ? $msg['content'] : "Message hidden. Please log in to view.");
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>

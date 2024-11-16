<?php
session_start();
include "../includes/conn.php";

// Ensure the database connection is successful
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle form submission for posting a message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = trim($_POST['message']); // Sanitize input
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; // Use 0 if user is not logged in

    if (!empty($content)) {
        // Insert the message into the database
        $query = "INSERT INTO messages (user_id, content) VALUES (?, ?)";
        $stmt = mysqli_prepare($con, $query);

        // Bind parameters: "i" for integer (user_id), "s" for string (content)
        mysqli_stmt_bind_param($stmt, "is", $user_id, $content);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: feed.php?success=Message posted successfully!");
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Message cannot be empty.";
    }
}
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

        <!-- Form to post a message -->
        <form method="POST" action="">
            <textarea name="message" required placeholder="Write your message here..."
                class="w-full h-24 p-3 border rounded mb-4"></textarea>
            <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600">
                Post Message
            </button>
        </form>
        <div class="mt-8">
            <a href="feed.php" class="text-blue-500 underline">Go to Feed</a>
        </div>
    </div>
</body>
</html>

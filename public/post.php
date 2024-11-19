<?php
session_start();
include "../includes/conn.php";

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

function get_mac_address() {
    $mac = exec('getmac');
    return $mac;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = trim($_POST['message']);
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $mac_address = get_mac_address();

    if (!empty($content)) {
        $query = "INSERT INTO messages (user_id, content, ip_address, mac_address) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "isss", $user_id, $content, $ip_address, $mac_address);

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
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-lg bg-gray-800 p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-4 text-center text-purple-400">Post a Message</h1>

        <form method="POST" action="" class="space-y-4">
            <textarea name="message" required placeholder="Write your message here..."
                class="w-full h-24 p-4 bg-gray-700 text-white rounded-lg border border-gray-600 focus:ring-2 focus:ring-purple-500 focus:outline-none"></textarea>
            <button type="submit"
                class="w-full bg-purple-500 hover:bg-purple-600 text-white font-bold py-3 rounded-lg transition ease-in-out duration-200">
                Post Message
            </button>
        </form>

        <div class="text-center mt-6">
            <a href="feed.php" class="text-purple-400 hover:underline text-lg">Go to Feed</a>
        </div>
    </div>

</body>
</html>

<?php
include "../includes/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: post.php");
            exit;
        } else {
            $error = "Invalid credentials!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="container mx-auto max-w-md bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center text-purple-400 mb-6">Login</h1>
        <?php if (isset($error)): ?>
            <p class="text-red-500 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="" method="POST" class="space-y-6">
            <div>
                <label class="block text-gray-300 font-medium mb-2">Username</label>
                <input type="text" name="username" class="w-full p-3 bg-gray-700 border border-gray-600 rounded focus:ring-2 focus:ring-purple-500 text-white" required>
            </div>
            <div>
                <label class="block text-gray-300 font-medium mb-2">Password</label>
                <input type="password" name="password" class="w-full p-3 bg-gray-700 border border-gray-600 rounded focus:ring-2 focus:ring-purple-500 text-white" required>
            </div>
            <button type="submit" class="w-full py-2 bg-purple-500 rounded text-white font-medium hover:bg-purple-600">
                Login
            </button>
        </form>
        <p class="text-center mt-4 text-gray-400">
            Don't have an account? <a href="register.php" class="text-purple-400 underline hover:text-purple-500">Sign up here</a>.
        </p>
    </div>
</body>
</html>

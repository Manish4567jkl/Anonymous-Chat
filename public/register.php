<?php
// Include the database connection file
include "../includes/conn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username already exists
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $error = "Username already exists. Please choose another.";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert the user into the database
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
        if (mysqli_query($con, $query)) {
            // Redirect to login page after successful signup
            header("Location: login.php?signup=success");
            exit();
        } else {
            $error = "Error: Could not register user. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="container mx-auto p-8 max-w-md bg-gray-800 shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold mb-6 text-purple-400 text-center">Sign Up</h1>
        <?php if (isset($error)): ?>
            <p class="text-red-500 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-4">
                <label for="username" class="block text-gray-300 font-medium mb-2">Username</label>
                <input type="text" name="username" id="username" required
                       class="w-full p-3 bg-gray-700 border border-gray-600 rounded focus:ring-2 focus:ring-purple-500 text-white">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-300 font-medium mb-2">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full p-3 bg-gray-700 border border-gray-600 rounded focus:ring-2 focus:ring-purple-500 text-white">
            </div>
            <button type="submit" class="w-full bg-purple-500 text-white py-2 rounded hover:bg-purple-600">
                Register
            </button>
        </form>
        <p class="mt-4 text-center text-gray-400">
            Already have an account? <a href="login.php" class="text-purple-400 underline hover:text-purple-500">Log in here</a>.
        </p>
    </div>
</body>
</html>

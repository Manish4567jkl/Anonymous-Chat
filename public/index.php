<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anonymous Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom Animation for SVG */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        /* SVG Styles */
        .icon {
            width: 50px;
            height: 50px;
            fill: #00c6ff;
            animation: fadeIn 1s ease-in-out;
        }

        /* Hover Effect for Links */
        .link-hover:hover {
            text-decoration: underline;
            color: #00c6ff;
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans flex items-center justify-center min-h-screen">

    <!-- Main Content Area -->
    <div class="container text-center px-6 py-16 max-w-xl">
        
        <!-- Header with SVG -->
        <div class="flex justify-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="icon">
                <circle cx="32" cy="32" r="30" stroke="none" stroke-width="2" fill="#00c6ff" />
                <path d="M21 32h22" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                <path d="M32 21v22" stroke="#fff" stroke-width="2" stroke-linecap="round" />
            </svg>
        </div>

        <!-- Title -->
        <h1 class="text-5xl font-extrabold mb-6">Anonymous Chat</h1>
        
        <!-- Description -->
        <p class="text-lg text-gray-300 mb-8">A secure space to share your thoughts freely without revealing your identity.</p>

        <!-- Call-to-Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-6 justify-center mb-6">
            <a href="login.php" 
                class="px-8 py-3 bg-blue-600 text-white rounded-full shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
                Log In
            </a>
            <a href="register.php" 
                class="px-8 py-3 bg-green-600 text-white rounded-full shadow-md hover:bg-green-700 transition duration-300 ease-in-out">
                Sign Up
            </a>
        </div>

        <!-- Secondary Action Link with SVG -->
        <p class="text-lg text-gray-300 mt-8">
            Want to post right away? <a href="post.php" class="link-hover">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="inline-block icon mr-2">
                    <path d="M21 12l-18 0" stroke="#00c6ff" stroke-width="2" stroke-linecap="round"/>
                    <path d="M12 21l0-18" stroke="#00c6ff" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Start posting without logging in
            </a>.
        </p>
    </div>

</body>
</html>

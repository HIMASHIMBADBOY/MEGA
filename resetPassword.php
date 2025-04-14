<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Get the token
$token = $_GET['token'] ?? null;

// Hash the token
$token_hash = hash("sha256", $token);

// Check if the token is valid
require_once "Config/functions.php";
require_once "Config/dbh.classes.php";
require_once "Models/passwordUpdates.classes.php";

$token_verify = new Password();
$token_verify->checkToken($token_hash);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | HSFAMIS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            border-top-color: #ffffff;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <!-- Loading Screen -->
    <div id="loading-screen">
        <div class="loading-spinner"></div>
    </div>

    <!-- Main Content -->
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8 mx-4 animate-fadeIn">
        <div class="text-center mb-6">
            <img src="../images/hsfamis-logo.jpg" alt="HSFAMIS Logo" class="h-16 mx-auto mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Reset Your Password</h1>
            <p class="text-gray-600">Enter your new password below to reset your account.</p>
        </div>

        <form action="includes/newPassword.inc.php" method="post" class="space-y-4">
            <div>
                <label for="newPassword" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" id="newPassword" name="newPassword" placeholder="Enter new password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <input type="hidden" name="token" value="<?= htmlspecialchars($token); ?>">
            <button type="submit" name="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300">
                <i class="fas fa-lock mr-2"></i> Reset Password
            </button>
        </form>

        <div class="text-center mt-6">
            <a href="Signin.php" class="text-blue-600 hover:underline">Back to Sign In</a>
        </div>
    </div>

    <script>
        // Handle form submission with loading screen
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            // Show loading screen
            document.getElementById('loading-screen').style.display = 'flex';
        });
    </script>
</body>
</html>
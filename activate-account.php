<?php
session_start();
require_once "Config/functions.php";
require_once "Config/dbh.classes.php";

// Get the activation token from the query parameter
$token = $_GET["token"] ?? null;
$token_hash = hash("sha256", $token);

$activate = new Db();

// Fetch the user with the matching activation token
try {
    $sql = "SELECT * FROM users WHERE account_activation_hash = ?";
    $stmt = $activate->connection()->prepare($sql);
    $stmt->execute([$token_hash]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// Check if a user was found
if ($user === false) {
    die("Invalid or expired activation token.");
}

// Update the user's account activation status
try {
    $sql = 'UPDATE users SET account_activation_hash = NULL WHERE user_id = ?';
    $stmt = $activate->connection()->prepare($sql);
    $stmt->execute([$user["user_id"]]);
} catch (PDOException $e) {
    die("Activation failed: " . $e->getMessage());
}

$_SESSION['success'] = "Your account has been activated successfully!";

session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activated | HSFAMIS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8 mx-4">
        <div class="text-center mb-6">
            <img src="../images/hsfamis-logo.jpg" alt="HSFAMIS Logo" class="h-16 mx-auto mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Account Activated</h1>
        </div>
        
        <div class="text-center">
            <i class="fas fa-check-circle text-5xl text-green-500 mb-4"></i>
            <p class="text-gray-600 mb-6">Your account was successfully activated!</p>
            <a href="Signin.php" id="signin-link" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg inline-flex items-center transition-colors duration-300">
                <i class="fas fa-sign-in-alt mr-2"></i> Sign In Now
            </a>
        </div>
    </div>

    <script>
        // Handle the sign-in link click with loading screen
        document.getElementById('signin-link').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Show loading screen
            document.getElementById('loading-screen').style.display = 'flex';
            
            // Redirect after 4 seconds
            setTimeout(() => {
                window.location.href = this.href;
            }, 4000);
        });
    </script>
</body>
</html>
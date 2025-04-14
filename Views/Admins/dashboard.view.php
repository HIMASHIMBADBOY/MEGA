<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Verify admin privileges here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-in-out;
        }
        .btn-hover-effect {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-hover-effect:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-6xl w-full px-4">
        <!-- Header with Logo and Title -->
        <div class="text-center mb-8 animate-fadeIn">
            <div class="flex items-center justify-center mb-4">
                <!-- Admin Shield Logo -->
                <i class="fas fa-shield-alt text-5xl text-blue-600"></i>
                <h1 class="text-5xl font-bold text-gray-800 ml-4">HSFAMIS Admin</h1>
            </div>
            <h3 class="text-2xl text-gray-600">Welcome, <span class="font-semibold text-gray-900"><?php echo $_SESSION['useruid']; ?></span></h3>
        </div>

        <!-- Dashboard Cards -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-8 transform transition-transform hover:scale-105 hover:shadow-2xl">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Management Cards -->
                <a href="../../Includes/fields.inc.php" class="btn-hover-effect block w-full text-center bg-blue-50 text-blue-700 py-4 px-6 rounded-lg hover:bg-blue-100 transition-all flex items-center justify-center gap-3">
                    <i class="fas fa-cogs text-2xl"></i> Field Management
                </a>
                
                <a href="../../Includes/Application.inc.php" class="btn-hover-effect block w-full text-center bg-purple-50 text-purple-700 py-4 px-6 rounded-lg hover:bg-purple-100 transition-all flex items-center justify-center gap-3">
                    <i class="fas fa-tasks text-2xl"></i> Application Management
                </a>

                <!-- <a href="user-management.php" class="btn-hover-effect block w-full text-center bg-green-50 text-green-700 py-4 px-6 rounded-lg hover:bg-green-100 transition-all flex items-center justify-center gap-3">
                    <i class="fas fa-users-cog text-2xl"></i> User Management
                </a> -->

                <!-- <a href="settings.php" class="btn-hover-effect block w-full text-center bg-red-50 text-red-700 py-4 px-6 rounded-lg hover:bg-red-100 transition-all flex items-center justify-center gap-3">
                    <i class="fas fa-sliders-h text-2xl"></i> System Settings
                </a> -->

                <a href="../../signout.php" class="btn-hover-effect block w-full text-center bg-gray-100 text-gray-700 py-4 px-6 rounded-lg hover:bg-gray-200 transition-all flex items-center justify-center gap-3">
                    <i class="fas fa-sign-out-alt text-2xl"></i> Logout
                </a>
            </div>
        </div>
    </div>
</body>
</html>
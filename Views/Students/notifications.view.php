<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
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
        .logo-hover {
            transition: transform 0.3s ease;
        }
        .logo-hover:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header Section -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- HSFAMIS Logo -->
            <a href="../Views/Students/dashboard.view.php" class="logo-hover flex items-center gap-3">
                <i class="fas fa-graduation-cap text-3xl text-gray-800"></i>
                <span class="text-2xl font-bold text-gray-800">HSFAMIS</span>
            </a>
            
            <!-- Action Button -->
            <a href="../Views/Students/dashboard.view.php" class="bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-all transform hover:scale-105 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Page Title -->
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8 animate-fadeIn flex items-center justify-center gap-3">
            <i class="fas fa-bell text-blue-500"></i>
            Notifications
        </h1>

        <!-- Notifications Grid -->
        <?php if (!empty($notifications)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fadeIn">
                <?php foreach ($notifications as $notification): ?>
                    <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 transition-all hover:transform hover:-translate-y-2 hover:shadow-xl">
                        <div class="flex items-center gap-3 mb-4">
                            <i class="fas fa-envelope-open-text text-2xl text-gray-700"></i>
                            <h3 class="text-xl font-semibold text-gray-800">
                                <?php echo htmlspecialchars($notification['field_name'] ?? ''); ?>
                            </h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            <?php echo htmlspecialchars($notification['message'] ?? ''); ?>
                        </p>
                        <a href="<?php echo htmlspecialchars($notification['confirmation_letter'] ?? ''); ?>" 
                           class="bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-all flex items-center gap-2"
                           download>
                            <i class="fas fa-download"></i>
                            Download Cover Letter
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12 animate-fadeIn">
                <p class="text-gray-600 text-xl">
                    <i class="fas fa-inbox text-3xl mb-4"></i><br>
                    No new notifications
                </p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
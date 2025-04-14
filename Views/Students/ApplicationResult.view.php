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
    <title>Manage Applications</title>
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
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header Section -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- HSFAMIS Logo (Matching Dashboard) -->
            <a href="../Views/Students/dashboard.view.php" class="flex items-center gap-3 hover:scale-105 transition-transform">
                <i class="fas fa-graduation-cap text-3xl text-gray-800"></i>
                <span class="text-2xl font-bold text-gray-800">HSFAMIS</span>
            </a>

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <a href="../Views/Students/dashboard.view.php" 
                   class="bg-gray-100 text-gray-800 py-2 px-4 rounded-lg hover:bg-gray-200 transition-all flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Dashboard
                </a>
                <a href="../../signout.php" 
                   class="bg-gray-100 text-gray-800 py-2 px-4 rounded-lg hover:bg-gray-200 transition-all flex items-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="mb-8 animate-fadeIn">
            <h1 class="text-4xl font-bold text-center text-gray-800 flex items-center justify-center gap-3">
                <i class="fas fa-tasks text-gray-700"></i>
                Manage Applications
            </h1>
            <p class="text-center text-gray-600 mt-2">Track your application progress and status</p>
        </div>

        <!-- Application List -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 animate-fadeIn">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-file-alt text-gray-600"></i>
                    Application History
                </h2>
                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                    <?php echo count($result ?? []); ?> Applications
                </span>
            </div>

            <?php if (isset($result) && !empty($result)): ?>
                <div class="grid grid-cols-1 gap-4">
                    <?php foreach ($result as $results): ?>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 hover:bg-white hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                        <i class="fas fa-briefcase text-gray-600"></i>
                                        <?php echo htmlspecialchars($results['field_name'] ?? ''); ?>
                                    </h3>
                                    <p class="text-gray-600 text-sm mt-1 flex items-center gap-2">
                                        <i class="fas fa-calendar-day"></i>
                                        Submitted: <?php echo date('M d, Y', strtotime($results['submission_date'] ?? '')); ?>
                                    </p>
                                </div>
                                <span class="<?php echo getStatusStyle($results['application_status'] ?? ''); ?> px-3 py-1 rounded-full text-sm flex items-center gap-2">
                                    <i class="<?php echo getStatusIcon($results['application_status'] ?? ''); ?>"></i>
                                    <?php echo htmlspecialchars($results['application_status'] ?? ''); ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8 text-gray-600">
                    <i class="fas fa-folder-open text-4xl mb-4"></i>
                    <p class="text-xl">No applications found</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php
    function getStatusStyle($status) {
        $status = strtolower($status);
        $styles = [
            'approved' => 'bg-gray-100 text-gray-800',
            'pending' => 'bg-gray-200 text-gray-800',
            'rejected' => 'bg-gray-300 text-gray-800',
            'default' => 'bg-gray-100 text-gray-800'
        ];
        return $styles[$status] ?? $styles['default'];
    }

    function getStatusIcon($status) {
        $status = strtolower($status);
        $icons = [
            'approved' => 'fas fa-check',
            'pending' => 'fas fa-clock',
            'rejected' => 'fas fa-times',
            'default' => 'fas fa-question'
        ];
        return $icons[$status] ?? $icons['default'];
    }
    ?>
</body>
</html>
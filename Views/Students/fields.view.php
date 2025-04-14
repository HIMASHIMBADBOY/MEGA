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
    <title>Available Fields</title>
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
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-6xl w-full px-4 py-8">
        <!-- Header with Action Buttons -->
        <div class="flex justify-between items-center mb-8">
            <a href="../Views/Students/dashboard.view.php" class="bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-all transform hover:scale-105 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
            <a href="../signout.php" class="bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-all transform hover:scale-105 flex items-center gap-2">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

        <!-- Page Title -->
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-8 animate-fadeIn">Available Fields</h2>

        <!-- Error Message -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-8 animate-fadeIn">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Fields Table -->
        <?php if (isset($fields) && !empty($fields)): ?>
            <div class="bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden animate-fadeIn">
                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Description</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Location</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($fields as $field): ?>
                            <tr class="hover:bg-gray-50 transition-all">
                                <td class="px-6 py-4 text-sm text-gray-700"><?php echo htmlspecialchars($field['field_name'] ?? ''); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?php echo htmlspecialchars($field['description'] ?? ''); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?php echo htmlspecialchars($field['location'] ?? ''); ?></td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="applicationManage.inc.php?field_id=<?php echo $field['field_id'] ?? ''; ?>" class="bg-gray-100 text-gray-700 py-1 px-3 rounded-lg hover:bg-gray-200 transition-all transform hover:scale-105 flex items-center gap-2">
                                        <i class="fas fa-check"></i> Apply
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-600 animate-fadeIn">No fields available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
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
    <title>Manage Fields</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }
        .hover-scale {
            transition: transform 0.2s ease-in-out;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-8 animate-fadeIn">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <div class="flex items-center mb-4 md:mb-0">
                <i class="fas fa-briefcase text-3xl text-gray-800 mr-3"></i>
                <h1 class="text-3xl font-bold text-gray-800">Field Management</h1>
            </div>
            
            <div class="space-x-4">
                <a href="../Views/Admins/dashboard.view.php" 
                   class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                   <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                </a>
                <a href="../signout.php" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition-colors">
                   <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </div>

        <!-- Fields Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover-scale">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-list-ul mr-2 text-gray-600"></i>Field List
                </h2>
            </div>

            <?php if (isset($fields) && !empty($fields)): ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">
                                    <i class="fas fa-tag mr-2"></i>Name
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">
                                    <i class="fas fa-align-left mr-2"></i>Description
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Location
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($fields as $field): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-800"><?php echo htmlspecialchars($field['field_name'] ?? ''); ?></td>
                                    <td class="px-6 py-4 text-gray-600"><?php echo htmlspecialchars($field['description'] ?? ''); ?></td>
                                    <td class="px-6 py-4 text-gray-600"><?php echo htmlspecialchars($field['location'] ?? ''); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="p-8 text-center text-gray-600">
                    <i class="fas fa-inbox text-4xl mb-4"></i>
                    <p class="text-lg">No fields found in the system</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Update Section -->
        <div class="mt-8 text-center">
            <a href="../Views/Admins/manageFields.view.php" 
               class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors inline-block">
               <i class="fas fa-sync-alt mr-2"></i>Update Fields
            </a>
        </div>
    </div>
</body>
</html>
<!-- filepath: e:\Programming\Projects\MEGA\Views\Admins\manageFields.view.php -->
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
            animation: fadeIn 0.4s ease-out;
        }
        .hover-scale {
            transition: transform 0.2s ease;
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
                <div class="flex items-center bg-white p-3 rounded-xl shadow-sm">
                    <i class="fas fa-graduation-cap text-3xl text-gray-800 mr-3"></i>
                    <h1 class="text-2xl font-bold text-gray-800">
                        <span class="text-gray-600">HSFAMIS</span><br>
                        <span class="text-sm font-normal">Field Management</span>
                    </h1>
                </div>
            </div>
            
            <div class="flex space-x-3">
                <a href="dashboard.view.php" 
                   class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors flex items-center">
                   <i class="fas fa-arrow-left mr-2"></i>Dashboard
                </a>
                <a href="../signout.php" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition-colors flex items-center">
                   <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 hover-scale">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-plus-circle mr-2 text-gray-600"></i>Add New Field
            </h2>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i><?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i><?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form id="addFieldForm" class="space-y-4">
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Field Name</label>
                    <input type="text" name="field_name" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent"
                           required>
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Description</label>
                    <input type="text" name="description" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent"
                           required>
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Location</label>
                    <input type="text" name="location" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent"
                           required>
                </div>
                
                <button type="submit" 
                        class="w-full bg-gray-800 text-white py-3 rounded-lg hover:bg-gray-700 transition-colors flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i>Add Field
                </button>
            </form>
        </div>

        <!-- Field List Section -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Description</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Location</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody id="fieldsTableBody" class="divide-y divide-gray-200">
                    <?php if (isset($data) && !empty($data)): ?>
                        <?php foreach ($data as $field): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-800 font-medium"><?php echo htmlspecialchars($field['field_name'] ?? ''); ?></td>
                                <td class="px-6 py-4 text-gray-600"><?php echo htmlspecialchars($field['description'] ?? ''); ?></td>
                                <td class="px-6 py-4 text-gray-600"><?php echo htmlspecialchars($field['location'] ?? ''); ?></td>
                                <td class="px-6 py-4 space-x-2">
    <button class="edit-field text-gray-600 hover:text-gray-900 px-3 py-1 rounded-md transition-colors" data-id="<?php echo $field['field_id']; ?>">
        <i class="fas fa-edit mr-1"></i>Edit
    </button>
    <button class="delete-field text-red-600 hover:text-red-800 px-3 py-1 rounded-md transition-colors" data-id="<?php echo $field['field_id']; ?>">
        <i class="fas fa-trash-alt mr-1"></i>Delete
    </button>
</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-600">No fields available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>       
    </div>
    <script src="../../Assets/field.js"></script>
</body>
</html>
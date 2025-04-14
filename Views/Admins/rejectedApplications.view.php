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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.4s ease-out; }
        .feedback-transition {
            transition: opacity 0.2s ease, transform 0.2s ease;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-8 animate-fadeIn">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start mb-8 space-y-4 md:space-y-0">
            <div class="flex items-center">
                <div class="flex items-center bg-white p-3 rounded-xl shadow-sm">
                    <i class="fas fa-graduation-cap text-3xl text-gray-800 mr-3"></i>
                    <h1 class="text-2xl font-bold text-gray-800">
                        <span class="text-gray-600">HSFAMIS</span><br>
                        <span class="text-sm font-normal">Application Management</span>
                    </h1>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-3">
                <a href="../Views/Admins/dashboard.view.php" 
                   class="bg-white text-gray-800 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition-colors flex items-center">
                   <i class="fas fa-arrow-left mr-2"></i>Dashboard
                </a>
                <a href="applicationApproval.inc.php" 
                   class="bg-white text-gray-800 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition-colors flex items-center">
                   <i class="fas fa-check-circle mr-2"></i>Approved
                </a>
                <a href="../../signout.php" 
                   class="bg-white text-gray-800 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition-colors flex items-center">
                   <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <?php if (isset($approved) && !empty($approved)): ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Applicant</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Field</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Documents</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Feedback</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($approved as $application): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-800 font-medium">
                                        <?php echo htmlspecialchars($application['user_uid'] ?? ''); ?>
                                    </td>
                                    <td class="px-6 py-4 text-gray-800">
                                        <?php echo htmlspecialchars($application['field_name'] ?? ''); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-800">
                                            <?php echo htmlspecialchars($application['application_status'] ?? ''); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 space-x-2">
                                        <button onclick="openFile('<?php echo htmlspecialchars($application['resumee'] ?? '');?>')" 
                                                class="text-gray-600 hover:text-gray-800 flex items-center">
                                            <i class="fas fa-file-pdf mr-2"></i>Resume
                                        </button>
                                        <button onclick="openFile('<?php echo htmlspecialchars($application['cover_letter'] ?? '');?>')" 
                                                class="text-gray-600 hover:text-gray-800 flex items-center">
                                            <i class="fas fa-file-word mr-2"></i>Cover
                                        </button>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button onclick="showFeedbackForm('<?php echo htmlspecialchars($application['id'] ?? ''); ?>')" 
                                                class="text-gray-600 hover:text-gray-800 flex items-center">
                                            <i class="fas fa-comment-dots mr-2"></i>Feedback
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="p-8 text-center text-gray-600">
                    <i class="fas fa-inbox text-4xl mb-4"></i>
                    <p class="text-lg">No approved applications found</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Feedback Form -->
        <div id="show" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center p-4">
            <div class="bg-white rounded-xl p-6 w-full max-w-md feedback-transition opacity-0 transform -translate-y-4">
                <form id="feedbackForm" method="POST" enctype="multipart/form-data" class="space-y-4">
    <input type="hidden" id="applicationId" name="applicationId">
    <input type="hidden" id="feedbackMessage" name="message">
    <div class="flex justify-between items-center">
        <h3 class="text-lg font-semibold"><i class="fas fa-comment-medical mr-2"></i>Provide Feedback</h3>
        <button type="button" onclick="hideFeedbackForm()" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <!-- Confirmation Letter Upload -->
    <div class="space-y-2">
        <label for="confirmationLetter" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-file-pdf mr-2"></i>Confirmation Letter (.pdf)
        </label>
        <input type="file" 
               id="confirmationLetter" 
               name="confirmationLetter" 
               accept=".pdf"
               required
               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
    </div>

    <!-- Feedback Textarea -->
    <textarea name="feedback" 
              rows="4" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent"
              placeholder="Enter your feedback..."></textarea>

    <div class="flex justify-end space-x-3">
        <button type="button" onclick="hideFeedbackForm()" 
                class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
        <button type="submit" onclick="submitFeedback(event)"
                class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700">Submit</button>
    </div>
</form>
            </div>
        </div>
    </div>

    <script src="../../Assets/status.js"></script>
  
</body>
</html>
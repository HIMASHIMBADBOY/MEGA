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
        .hover-scale { transition: transform 0.2s ease; }
        .hover-scale:hover { transform: scale(1.02); }

        .feedback-transition {
    transition: all 0.2s ease-out;
    }

   .opacity-0 {
    opacity: 0;
    }

   .opacity-100 {
    opacity: 1;
   }

   .translate-y-0 {
    transform: translateY(0);
   }

   .-translate-y-4 {
    transform: translateY(-1rem); /* Adjust as needed */
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
            
            <div class="flex flex-col md:flex-row md:items-center gap-3">
                <div class="flex space-x-3">
                    <a href="../Views/Admins/dashboard.view.php" 
                       class="bg-white text-gray-800 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition-colors flex items-center">
                       <i class="fas fa-arrow-left mr-2"></i>Dashboard
                    </a>
                    <a href="../../signout.php" 
                       class="bg-white text-gray-800 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition-colors flex items-center">
                       <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </div>
                <div class="flex space-x-3 border-l md:border-l-0 md:border-t-0 border-gray-200 md:pl-3 pl-0 md:mt-0 mt-3">
                    <a href="applicationApproval.inc.php" 
                       class="bg-white text-gray-800 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition-colors flex items-center">
                       <i class="fas fa-check-circle mr-2"></i>Approved
                    </a>
                    <a href="ApplicationDenial.inc.php" 
                       class="bg-white text-gray-800 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition-colors flex items-center">
                       <i class="fas fa-times-circle mr-2"></i>Rejected
                    </a>
                </div>
            </div>
        </div>

        <!-- Applications Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover-scale">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-file-alt mr-2 text-gray-600"></i>Application List
                </h2>
            </div>

            <?php if (isset($applications) && !empty($applications)): ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">User</th>
                                
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Documents</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Submitted</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Feedback</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
    <?php foreach ($applications as $application): ?>
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4 text-gray-800 font-medium"><?php echo htmlspecialchars($application['user_uid'] ?? ''); ?></td>
            <td class="px-6 py-4 text-gray-600">
                <?php $status = $application['application_status'] ?? ''; ?>
                <span class="flex items-center">
                    <?php if ($status === 'Approved'): ?>
                        <i class="fas fa-check-circle mr-2 text-gray-600"></i>
                    <?php elseif ($status === 'Rejected'): ?>
                        <i class="fas fa-times-circle mr-2 text-gray-600"></i>
                    <?php else: ?>
                        <i class="fas fa-clock mr-2 text-gray-600"></i>
                    <?php endif; ?>
                    <span id="stts- <?php echo $application['id']; ?>"><?php echo htmlspecialchars($status); ?></span>
                </span>
            </td>
            <td class="px-6 py-4 space-x-3">
                <button onclick="openFile('<?php echo htmlspecialchars($application['resumee'] ?? '');?>')" 
                        class="text-gray-600 hover:text-gray-800 flex items-center">
                    <i class="fas fa-file-pdf mr-1"></i>Resume
                </button>
                <button onclick="openFile('<?php echo htmlspecialchars($application['cover_letter'] ?? '');?>')" 
                        class="text-gray-600 hover:text-gray-800 flex items-center">
                    <i class="fas fa-file-word mr-1"></i>Cover
                </button>
            </td>
            <td class="px-6 py-4 text-gray-600"><?php echo htmlspecialchars($application['submission_date'] ?? ''); ?></td>
            <td class="px-6 py-4 space-x-3">
                <button onclick="updateApplicationStatus(<?php echo $application['id']; ?>, 'Approved')" 
                        class="text-gray-600 hover:text-gray-800 flex items-center">
                    <i class="fas fa-check mr-1"></i>Accept
                </button>
                <span class="text-gray-300">||</span>
                <button onclick="updateApplicationStatus(<?php echo $application['id']; ?>, 'Rejected')" 
                        class="text-gray-600 hover:text-gray-800 flex items-center">
                    <i class="fas fa-times mr-1"></i>Reject
                </button>
            </td>
            <td class="px-6 py-4">
            <button onclick="showFeedbackForm('<?php echo htmlspecialchars($application['id'] ?? ''); ?>')" 
             class="text-gray-600 hover:text-gray-800 flex items-center">
            <i class="fas fa-comment-dots mr-2"></i>Add Feedback
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
                    <p class="text-lg">No pending applications</p>
                </div>
            <?php endif; ?>
        </div>
        <!-- Feedback Form Container -->
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
    <textarea id="feedbackText" 
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

    <!-- Add this right after the Applications Section div -->
<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Search Input -->
        <div>
            <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <input type="text" id="searchInput" placeholder="Search by name or status..." 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
        </div>
        
        <!-- Status Filter -->
        <div>
            <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select id="statusFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                <option value="">All Statuses</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="pending">Pending</option>
            </select>
        </div>
        
        <!-- Date Filter -->
        <div>
            <label for="dateFilter" class="block text-sm font-medium text-gray-700 mb-1">Submission Date</label>
            <input type="date" id="dateFilter" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
        </div>
        
        <!-- Sort Order -->
        <div>
            <label for="sortOrder" class="block text-sm font-medium text-gray-700 mb-1">Sort By Name</label>
            <select id="sortOrder" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                <option value="ASC">A-Z</option>
                <option value="DESC">Z-A</option>
            </select>
        </div>
    </div>
</div>
    <script src="../../Assets/status.js"></script>
</body>
</html>
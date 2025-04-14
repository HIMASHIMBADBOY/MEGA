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
    <title>Apply for Field</title>
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

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <a href="../../Includes/Student.inc.php" class="bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-all transform hover:scale-105 flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Back to Fields
                </a>
                <a href="../signout.php" class="bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-all transform hover:scale-105 flex items-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Page Title with Icon -->
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8 animate-fadeIn flex items-center justify-center gap-3">
            <i class="fas fa-file-signature text-blue-500"></i> 
            Apply for Field
        </h1>

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-8">
                <!-- Field Details Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 animate-fadeIn">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-info-circle text-2xl text-gray-700"></i>
                        <h2 class="text-2xl font-semibold text-gray-800">Field Details</h2>
                    </div>
                    <?php if (isset($field)): ?>
                        <div class="space-y-3">
                            <p class="text-gray-700"><i class="fas fa-tag mr-2"></i><strong>Name:</strong> <?php echo htmlspecialchars($field['field_name'] ?? ''); ?></p>
                            <p class="text-gray-700"><i class="fas fa-align-left mr-2"></i><strong>Description:</strong> <?php echo htmlspecialchars($field['description'] ?? ''); ?></p>
                            <p class="text-gray-700"><i class="fas fa-map-marker-alt mr-2"></i><strong>Location:</strong> <?php echo htmlspecialchars($field['location'] ?? ''); ?></p>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-700">No field details available.</p>
                    <?php endif; ?>
                </div>

                <!-- Instructions Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 animate-fadeIn">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-clipboard-list text-2xl text-gray-700"></i>
                        <h3 class="text-2xl font-semibold text-gray-800">Instructions</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full">1</span>
                            <p class="text-gray-700">Download our resume template</p>
                        </div>
                        <a href="../../Assets/resume_template.docx" class="bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-all transform hover:scale-105 flex items-center gap-2" download>
                            <i class="fas fa-download"></i> Download Template
                        </a>

                        <div class="flex items-start gap-3 mt-4">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full">2</span>
                            <p class="text-gray-700">Fill out all required information</p>
                        </div>

                        <div class="flex items-start gap-3 mt-4">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full">3</span>
                            <p class="text-gray-700">Upload completed documents</p>
                        </div>

                        <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-red-600 text-sm"><i class="fas fa-exclamation-triangle mr-2"></i>Note: Incomplete or inaccurate applications will be rejected</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Application Form -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 animate-fadeIn">
                <div class="flex items-center gap-3 mb-6">
                    <i class="fas fa-edit text-2xl text-gray-700"></i>
                    <h2 class="text-2xl font-semibold text-gray-800">Application Form</h2>
                </div>

                <!-- Messages -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <!-- Form -->
                <form method="post" action="applicationManage.inc.php?field_id=<?php echo $field_id; ?>" enctype="multipart/form-data" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-file-pdf mr-2"></i>Upload Resume (PDF)
                        </label>
                        <input type="file" name="resume" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-file-alt mr-2"></i>Upload Cover Letter (PDF)
                        </label>
                        <input type="file" name="cover_letter" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <button type="submit" name="submit" class="w-full bg-blue-100 text-blue-800 py-3 px-6 rounded-lg hover:bg-blue-200 transition-all transform hover:scale-105 flex items-center justify-center gap-3">
                        <i class="fas fa-paper-plane"></i>
                        Submit Application
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
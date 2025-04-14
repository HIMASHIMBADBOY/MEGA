<?php
session_start();
if (!isset($_SESSION['useruid'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | HSFAMIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-in-out;
        }
        .logo-hover {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Modern Black & White Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Modern Logo -->
            <a href="dashboard.view.php" class="logo-hover flex items-center gap-3 hover:scale-105">
                <div class="border-2 border-black p-2 rounded-lg bg-white">
                    <i class="bi bi-mortarboard text-xl text-black"></i>
                </div>
                <span class="text-2xl font-bold text-black tracking-tighter">HSFAMIS</span>
            </a>
            
            <!-- Modern Sign Out Button -->
            <a href="logout.php" class="flex items-center gap-2 text-black hover:bg-gray-100 px-4 py-2 rounded-full transition-all">
                <i class="bi bi-box-arrow-right"></i>
                <span class="font-medium">Sign Out</span>
            </a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <div class="mb-8 animate-fadeIn">
            <div class="flex items-center gap-6">
                <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center">
                    <i class="bi bi-person-circle text-4xl text-gray-400"></i>
                </div>
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">Welcome, <?= $_SESSION['useruid'] ?> 👋</h1>
                    <p class="text-gray-600">Your Field Application Management Center</p>
                </div>
            </div>
        </div>

        <!-- Application Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <i class="bi bi-files text-2xl text-gray-800"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">3</p>
                        <p class="text-gray-600">Active Applications</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <i class="bi bi-check-circle text-2xl text-gray-800"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">5</p>
                        <p class="text-gray-600">Completed Placements</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <i class="bi bi-clock-history text-2xl text-gray-800"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">120h</p>
                        <p class="text-gray-600">Field Hours Logged</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Application Details -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                    <i class="bi bi-briefcase text-gray-800"></i>
                    Current Applications
                </h2>
                
                <div class="space-y-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-medium">Healthcare Internship</h3>
                                <p class="text-sm text-gray-600">Status: Under Review</p>
                            </div>
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                Active
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-medium">Engineering Placement</h3>
                                <p class="text-sm text-gray-600">Status: Interview Scheduled</p>
                            </div>
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                Pending
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Management -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                    <i class="bi bi-gear text-gray-800"></i>
                    Account Management
                </h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Username</label>
                        <div class="p-3 bg-gray-50 rounded-lg text-gray-800"><?= $_SESSION['useruid'] ?></div>
                    </div>
                    
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Contact Email</label>
                        <div class="p-3 bg-gray-50 rounded-lg text-gray-800"><?= $_SESSION['useremail'] ?? 'contact@student.edu' ?></div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <button class="w-full py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors">
                            Update Application Documents
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-12 border-t border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <p class="text-center text-gray-600">&copy; 2024 HSFAMIS - Field Application Management System</p>
        </div>
    </footer>
</body>
</html>
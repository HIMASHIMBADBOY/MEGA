<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | HSFAMIS</title>
    
    <style>
        /* Base styles */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            opacity: 0;
            animation: fadeIn 0.5s ease-in forwards;
        }
        
        @keyframes fadeIn {
            to { opacity: 1; }
        }
        
        /* Entrance loading screen */
        #entrance-loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
        }
        
        .entrance-spinner {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, rgba(0,122,255,0.1) 0%, #007AFF 100%);
            -webkit-mask: radial-gradient(farthest-side, transparent calc(100% - 8px), #000 0);
            mask: radial-gradient(farthest-side, transparent calc(100% - 8px), #000 0);
            animation: spin 1s linear infinite;
        }
        
        /* Page loading screen */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(10, 2, 19, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            border-top-color: #ffffff;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Main content container */
        .main-container {
            padding-top: 80px; /* Adjusted for fixed nav */
        }
        
        /* Navigation bar - Using original colors from uploaded file */
        .navbar {
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .nav-link {
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: white;
            transition: width 0.4s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Input icons */
        .input-container {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #8E8E93;
            font-size: 18px;
            pointer-events: none;
        }
        
        .eye-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #8E8E93;
            font-size: 18px;
            cursor: pointer;
            z-index: 10;
        }
        
        /* Form inputs */
        .ios-input {
            padding-left: 45px;
            padding-right: 45px;
            height: 52px;
            border-radius: 10px;
            border: 1px solid #E5E5EA;
            font-size: 16px;
            transition: all 0.2s;
            width: 100%;
            background-color: #ffffff;
        }
        
        .ios-input:focus {
            border-color: #007AFF;
            box-shadow: 0 0 0 2px rgba(0,122,255,0.2);
            outline: none;
        }
        
        /* Select element styling */
        .ios-select {
            height: 52px;
            border-radius: 10px;
            border: 1px solid #E5E5EA;
            font-size: 16px;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%238E8E93'%3e%3cpath d='M7 10l5 5 5-5z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
            padding-right: 40px;
            padding-left: 15px;
            width: 100%;
            background-color: #ffffff;
        }
        
        .ios-select:focus {
            border-color: #007AFF;
            box-shadow: 0 0 0 2px rgba(0,122,255,0.2);
            outline: none;
        }
        
        /* Buttons */
        .ios-button {
            height: 52px;
            border-radius: 10px;
            font-size: 17px;
            font-weight: 600;
            transition: all 0.2s;
            background-color: #007AFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        .ios-button:hover {
            background-color: #0066CC;
        }
        
        /* Social button */
        .ios-social-button {
            height: 52px;
            border-radius: 10px;
            font-size: 17px;
            font-weight: 500;
            transition: all 0.2s;
            border: 1px solid #E5E5EA;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
        }
        
        .ios-social-button:hover {
            background-color: #f5f5f5;
        }
        
        .social-icon {
            width: 20px;
            height: 20px;
        }
    </style>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Entrance Loading Screen -->
    <div id="entrance-loading">
        <div class="entrance-spinner"></div>
    </div>

    <!-- Page Loading Screen -->
    <div id="loading-screen">
        <div class="loading-spinner"></div>
    </div>

    <!-- Navigation Bar - Fixed at top -->
    <nav class="fixed w-full bg-gray-900 bg-opacity-90 text-white z-50 shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <img src="../images/hsfamis-logo.jpg" alt="HSFAMIS Logo" class="h-10 mr-2">
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="../index.php" class="nav-link hover:text-gray-300 transition-colors duration-300">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                    <a href="../index.php#programs" class="nav-link hover:text-gray-300 transition-colors duration-300">
                        <i class="fas fa-book-open mr-2"></i>Programs
                    </a>
                    <a href="../index.php#process" class="nav-link hover:text-gray-300 transition-colors duration-300">
                        <i class="fas fa-tasks mr-2"></i>Process
                    </a>
                    <a href="../index.php#contact" class="nav-link hover:text-gray-300 transition-colors duration-300">
                        <i class="fas fa-envelope mr-2"></i>Contact
                    </a>
                </div>
                
                <button class="md:hidden focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div id="main-content" class="main-container" style="display: none;">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-3xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <!-- Left Column - Graphic Section -->
                <div class="bg-gray-900 p-8 text-white">
                    <div class="flex flex-col h-full justify-between">
                        <div class="mb-8">
                            <a href="../index.php" class="flex items-center gap-3">
                                <img src="../images/hsfamis-logo.jpg" alt="HSFAMIS Logo" class="h-12 rounded-lg">
                            </a>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-3xl md:text-4xl font-bold mb-4">Join Our Community</h2>
                            <p class="text-gray-300">Start your educational journey with access to premium learning resources and expert guidance.</p>
                        </div>

                        <div class="mt-auto">
                            <div class="rounded-xl overflow-hidden">
                                <img src="../images/online-learning.jpeg" alt="Education" class="w-full max-w-xs mx-auto rounded-xl">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Signup Form -->
                <div class="p-8">
                    <form action="includes/signup.inc.php" method="post" class="space-y-6">
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex items-center gap-2">
                                <i class="fas fa-exclamation-circle"></i>
                                <span><?= $_SESSION['error']; unset($_SESSION['error']); ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Username Input -->
                        <div class="input-container">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" name="uid" class="ios-input" placeholder="Username" required>
                        </div>

                        <!-- Email Input -->
                        <div class="input-container">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email" class="ios-input" placeholder="Email address" required>
                        </div>

                        <!-- Password Input -->
                        <div class="input-container">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="pwd" id="password" class="ios-input" placeholder="Password" required>
                            <i class="fas fa-eye eye-icon" id="togglePassword"></i>
                        </div>

                        <!-- Repeat Password -->
                        <div class="input-container">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="rpwd" id="repeatPassword" class="ios-input" placeholder="Repeat Password" required>
                            <i class="fas fa-eye eye-icon" id="toggleRepeatPassword"></i>
                        </div>

                        <!-- Role Selection -->
                        <div>
                            <label class="block text-gray-700 mb-2">Select your role</label>
                            <select name="user_role" class="ios-select">
                                <option value="student">Student</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <!-- Sign Up Button -->
                        <button type="submit" name="submit" class="ios-button w-full">
                            Create Account
                        </button>

                        <!-- Social Login Divider -->
                        <div class="relative">
                            <hr class="my-6 border-gray-300">
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white px-4">
                                <span class="text-gray-500 text-sm">Or continue with</span>
                            </div>
                        </div>

                        <!-- Google Sign Up with custom icon -->
                        <button type="button" class="ios-social-button w-full">
                            <img src="../images/yui.png" alt="Google" class="social-icon">
                            <span>Google</span>
                        </button>

                        <!-- Login Link -->
                        <p class="text-center text-gray-600">
                            Already have an account? 
                            <a href="Signin.php" class="text-blue-600 font-semibold hover:text-blue-800 transition-colors duration-300">
                                Sign In
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Hide entrance loading screen and show content when page loads
        window.addEventListener('load', function() {
            setTimeout(function() {
                const entranceLoading = document.getElementById('entrance-loading');
                entranceLoading.style.opacity = '0';
                
                setTimeout(function() {
                    entranceLoading.style.display = 'none';
                    document.getElementById('main-content').style.display = 'block';
                }, 500);
            }, 1000);
        });

        // Password toggle functionality
        const togglePassword = (toggleId, inputId) => {
            const toggle = document.querySelector(toggleId);
            const input = document.querySelector(inputId);

            toggle.addEventListener('click', () => {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                toggle.classList.toggle('fa-eye-slash');
                toggle.classList.toggle('fa-eye');
            });
        }

        togglePassword('#togglePassword', '#password');
        togglePassword('#toggleRepeatPassword', '#repeatPassword');

        // Handle page transitions with loading screen
        document.addEventListener('click', function(e) {
            let target = e.target.closest('a');
            
            if (target && !target.classList.contains('no-loader')) {
                const href = target.getAttribute('href');
                if (href && !href.startsWith('#') && !href.startsWith('javascript:') && 
                    !href.startsWith('mailto:') && !href.startsWith('tel:')) {
                    e.preventDefault();
                    
                    // Show loading screen
                    const loadingScreen = document.getElementById('loading-screen');
                    loadingScreen.style.display = 'flex';
                    
                    // Hide main content
                    document.getElementById('main-content').style.opacity = '0';
                    
                    // Redirect after 4 seconds
                    setTimeout(() => {
                        window.location.href = href;
                    }, 4000);
                }
            }
        });
    </script>
</body>
</html>
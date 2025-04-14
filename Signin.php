<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | HSFAMIS</title>
    
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
            background-color:rgb(9, 6, 19);
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
            background-color: rgba(0, 0, 0, 0.9);
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
        
        /* Navigation bar - Using original colors */
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
        
        /* Checkbox styling */
        .ios-checkbox {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid #E5E5EA;
            appearance: none;
            position: relative;
            cursor: pointer;
        }
        
        .ios-checkbox:checked {
            background-color: #007AFF;
            border-color: #007AFF;
        }
        
        .ios-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 1px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
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
        
        /* Floating animation */
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        /* Glass effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Auth background */
        .auth-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/education-bg.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
    </style>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="auth-bg">
    <!-- Entrance Loading Screen -->
    <div id="entrance-loading">
        <div class="entrance-spinner"></div>
    </div>

    <!-- Page Loading Screen -->
    <div id="loading-screen">
        <div class="loading-spinner"></div>
    </div>

    <!-- Navigation Bar - Fixed at top -->
    <nav class="navbar fixed w-full bg-gray-900 bg-opacity-90 text-white z-50 shadow-lg">
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
    <div id="main-content" style="display: none;">
        <div class="w-full max-w-4xl glass-effect rounded-3xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <!-- Left Column - Graphic Section -->
                <div class="bg-gray-900 p-8 text-white position-relative">
                    <div class="flex flex-col h-full justify-between">
                        <!-- HSFAMIS Logo -->
                        <div class="mb-8">
                            <a href="#" class="flex items-center gap-3 text-decoration-none">
                                <div class="bg-blue-600 p-3 rounded-full">
                                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                                </div>
                                <span class="text-2xl font-bold text-white">HSFAMIS</span>
                            </a>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-3xl md:text-4xl font-bold mb-4">Welcome Back</h2>
                            <p class="text-gray-300">Empowering your educational journey through seamless access and innovative learning solutions.</p>
                        </div>

                        <div class="float-animation mt-auto">
                            <img src="images/online-learning.svg" alt="Education" class="w-full max-w-xs mx-auto">
                        </div>
                    </div>
                </div>

                <!-- Right Column - Login Form -->
                <div class="p-8">
                    <form action="includes/login.inc.php" method="post" class="space-y-6">
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex items-center gap-2">
                                <i class="fas fa-exclamation-circle"></i>
                                <span><?= $_SESSION['error']; unset($_SESSION['error']); ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Username/Email Input -->
                        <div class="input-container">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" name="user_uid" class="ios-input" placeholder="Username or Email" required>
                        </div>

                        <!-- Password Input -->
                        <div class="input-container">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="user_pwd" id="password" class="ios-input" placeholder="Password" required>
                            <i class="fas fa-eye eye-icon" id="togglePassword"></i>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <input type="checkbox" id="rememberMe" class="ios-checkbox mr-2">
                                <label for="rememberMe" class="text-gray-600">Remember me</label>
                            </div>
                            <a href="forgot-password.php" class="text-blue-600 hover:text-blue-800">Forgot password?</a>
                        </div>

                        <!-- Sign In Button -->
                        <button type="submit" name="submit" class="ios-button w-full">
                            Sign In
                        </button>

                        <!-- Social Login Divider -->
                        <div class="relative">
                            <hr class="my-6 border-gray-300">
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white px-4">
                                <span class="text-gray-500 text-sm">Or continue with</span>
                            </div>
                        </div>

                        <!-- Google Sign In -->
                        <button type="button" class="ios-social-button w-full">
                            <img src="../images/yui.png" alt="Google" class="social-icon">
                            <span>Google</span>
                        </button>

                        <!-- Registration Link -->
                        <p class="text-center text-gray-600">
                            Don't have an account? 
                            <a href="Signup.php" class="text-blue-600 font-semibold hover:text-blue-800">Create account</a>
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
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });

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
</html>
</body>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HSFAMIS Field Training - Tanzania</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        /* iOS-style loading animation */
        @keyframes loadingPulse {
            0% { transform: scale(0.8); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(0.8); opacity: 0.5; }
        }
        
        @keyframes loadingSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .animate-fade {
            animation: fadeIn 1s ease-out forwards;
            opacity: 0;
        }
        
        .animate-slide {
            animation: slideUp 0.8s ease-out forwards;
            opacity: 0;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .blurry-bg {
            position: relative;
            overflow: hidden;
        }
        
        .blurry-bg::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('../images/field-training-tanzania.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(8px) brightness(0.7);
            z-index: -1;
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
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        /* Loading overlay styles */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        
        .loading-overlay.active {
            opacity: 1;
            pointer-events: all;
        }
        
        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            border-top-color: #ffffff;
            animation: loadingSpin 1s linear infinite;
            margin-bottom: 20px;
        }
        
        .loading-dots {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .loading-dot {
            width: 12px;
            height: 12px;
            background-color: #ffffff;
            border-radius: 50%;
            margin: 0 5px;
            animation: loadingPulse 1.5s infinite ease-in-out;
        }
        
        .loading-dot:nth-child(1) {
            animation-delay: 0s;
        }
        
        .loading-dot:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .loading-dot:nth-child(3) {
            animation-delay: 0.4s;
        }
        
        .loading-text {
            color: white;
            font-size: 18px;
            margin-top: 20px;
            text-align: center;
            max-width: 300px;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-spinner"></div>
        <div class="loading-dots">
            <div class="loading-dot"></div>
            <div class="loading-dot"></div>
            <div class="loading-dot"></div>
        </div>
        <div class="loading-text">Preparing your application...</div>
    </div>

    <!-- Navigation -->
    <nav class="fixed w-full bg-gray-900 bg-opacity-90 text-white z-50 shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <img src="../images/hsfamis-logo.jpg" alt="HSFAMIS Logo" class="h-10 mr-2">
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="nav-link hover:text-gray-300 transition-colors duration-300">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                    <a href="#programs" class="nav-link hover:text-gray-300 transition-colors duration-300">
                        <i class="fas fa-book-open mr-2"></i>Programs
                    </a>
                    <a href="#process" class="nav-link hover:text-gray-300 transition-colors duration-300">
                        <i class="fas fa-tasks mr-2"></i>Process
                    </a>
                    <a href="#contact" class="nav-link hover:text-gray-300 transition-colors duration-300">
                        <i class="fas fa-envelope mr-2"></i>Contact
                    </a>
                    <a href="Signup.php" id="signupBtn" class="bg-white text-gray-800 px-4 py-2 rounded-lg font-medium hover:bg-gray-200 transition-colors duration-300">
                        <i class="fas fa-user-plus mr-2"></i>Sign Up
                    </a>
                </div>
                
                <button class="md:hidden text-white focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="blurry-bg min-h-screen flex items-center justify-center text-white pt-20">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto animate-fade" style="animation-delay: 0.2s;">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    FIELD TRAININGS IN <span class="block">TANZANIA</span>
                </h1>
                <p class="text-xl md:text-2xl mb-10 opacity-90">
                    THE STUDENTS ASSISTED WITH ONLINE FIELD APPLICATIONS
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="Signup.php" id="heroSignupBtn" class="bg-white text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-200 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-rocket mr-2"></i>Get Started
                    </a>
                    <a href="#programs" class="bg-transparent border-2 border-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-gray-900 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-book mr-2"></i>Our Programs
                    </a>
                </div>
            </div>
            
            <div class="mt-20 animate-float">
                <a href="#programs" class="text-white text-lg flex flex-col items-center">
                    <span>Explore More</span>
                    <i class="fas fa-chevron-down mt-2 text-xl animate-bounce"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="programs" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate-slide" style="animation-delay: 0.1s;">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800">
                    <i class="fas fa-graduation-cap mr-3 text-gray-600"></i>Our Training Programs
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    We offer comprehensive field training programs designed to prepare students for real-world challenges.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Program 1 -->
                <div class="bg-gray-50 rounded-xl p-6 shadow-md card-hover animate-slide" style="animation-delay: 0.2s;">
                    <div class="text-center mb-4">
                        <i class="fas fa-laptop-code text-5xl text-gray-700 mb-4"></i>
                        <h3 class="text-2xl font-semibold mb-2">Technology</h3>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Cutting-edge training in software development, data science, and IT infrastructure.
                    </p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Web Development</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Data Analysis</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Cybersecurity</span>
                        </li>
                    </ul>
                    <a href="#" class="text-gray-800 font-medium hover:text-gray-600 transition-colors duration-300 inline-flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <!-- Program 2 -->
                <div class="bg-gray-50 rounded-xl p-6 shadow-md card-hover animate-slide" style="animation-delay: 0.3s;">
                    <div class="text-center mb-4">
                        <i class="fas fa-briefcase text-5xl text-gray-700 mb-4"></i>
                        <h3 class="text-2xl font-semibold mb-2">Business</h3>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Practical business training covering management, marketing, and entrepreneurship.
                    </p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Business Management</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Digital Marketing</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Financial Analysis</span>
                        </li>
                    </ul>
                    <a href="#" class="text-gray-800 font-medium hover:text-gray-600 transition-colors duration-300 inline-flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <!-- Program 3 -->
                <div class="bg-gray-50 rounded-xl p-6 shadow-md card-hover animate-slide" style="animation-delay: 0.4s;">
                    <div class="text-center mb-4">
                        <i class="fas fa-flask text-5xl text-gray-700 mb-4"></i>
                        <h3 class="text-2xl font-semibold mb-2">Science</h3>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Hands-on scientific training in various fields including health and environmental sciences.
                    </p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Medical Laboratory</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Environmental Science</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Biotechnology</span>
                        </li>
                    </ul>
                    <a href="#" class="text-gray-800 font-medium hover:text-gray-600 transition-colors duration-300 inline-flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate-slide" style="animation-delay: 0.1s;">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800">
                    <i class="fas fa-cogs mr-3 text-gray-600"></i>Application Process
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Simple steps to get started with your field training application.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="bg-white rounded-xl p-6 shadow-md text-center card-hover animate-slide" style="animation-delay: 0.2s;">
                    <div class="bg-gray-800 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold">1</span>
                    </div>
                    <i class="fas fa-user-edit text-4xl text-gray-700 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Register</h3>
                    <p class="text-gray-600">
                        Create your account and complete your profile.
                    </p>
                </div>
                
                <!-- Step 2 -->
                <div class="bg-white rounded-xl p-6 shadow-md text-center card-hover animate-slide" style="animation-delay: 0.3s;">
                    <div class="bg-gray-800 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold">2</span>
                    </div>
                    <i class="fas fa-file-alt text-4xl text-gray-700 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Apply</h3>
                    <p class="text-gray-600">
                        Submit your application for the desired program.
                    </p>
                </div>
                
                <!-- Step 3 -->
                <div class="bg-white rounded-xl p-6 shadow-md text-center card-hover animate-slide" style="animation-delay: 0.4s;">
                    <div class="bg-gray-800 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold">3</span>
                    </div>
                    <i class="fas fa-search text-4xl text-gray-700 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Review</h3>
                    <p class="text-gray-600">
                        Our team will review your application.
                    </p>
                </div>
                
                <!-- Step 4 -->
                <div class="bg-white rounded-xl p-6 shadow-md text-center card-hover animate-slide" style="animation-delay: 0.5s;">
                    <div class="bg-gray-800 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold">4</span>
                    </div>
                    <i class="fas fa-check-circle text-4xl text-gray-700 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Confirmation</h3>
                    <p class="text-gray-600">
                        Receive your placement confirmation.
                    </p>
                </div>
            </div>
            
            <div class="text-center mt-12 animate-slide" style="animation-delay: 0.6s;">
                <a href="Signup.php" id="processSignupBtn" class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-700 transition-all duration-300 inline-flex items-center">
                    <i class="fas fa-play mr-2"></i> Start Your Application
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-gray-800 text-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate-slide" style="animation-delay: 0.1s;">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    <i class="fas fa-quote-left mr-3 text-gray-400"></i>Student Experiences
                </h2>
                <p class="text-gray-300 max-w-2xl mx-auto">
                    Hear from our students about their field training experiences.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gray-700 rounded-xl p-6 animate-slide" style="animation-delay: 0.2s;">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gray-600 flex items-center justify-center mr-4">
                            <i class="fas fa-user text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Juma J.</h4>
                            <p class="text-gray-400 text-sm">Technology Program</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">
                        "The field training gave me practical skills that directly translated to my current job. Highly recommended!"
                    </p>
                    <div class="text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-gray-700 rounded-xl p-6 animate-slide" style="animation-delay: 0.3s;">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gray-600 flex items-center justify-center mr-4">
                            <i class="fas fa-user text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Kisanga T.</h4>
                            <p class="text-gray-400 text-sm">Business Program</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">
                        "The mentorship I received during my training was invaluable. It helped me start my own business."
                    </p>
                    <div class="text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-gray-700 rounded-xl p-6 animate-slide" style="animation-delay: 0.4s;">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gray-600 flex items-center justify-center mr-4">
                            <i class="fas fa-user text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Amina K.</h4>
                            <p class="text-gray-400 text-sm">Science Program</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">
                        "The hands-on experience in the lab prepared me perfectly for my career in medical research."
                    </p>
                    <div class="text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate-slide" style="animation-delay: 0.1s;">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800">
                    <i class="fas fa-envelope mr-3 text-gray-600"></i>Contact Us
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Have questions? Get in touch with our team.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="animate-slide" style="animation-delay: 0.2s;">
                    <div id= "alerts">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            <strong>Success:</strong> <?= $_SESSION['success']; ?>
                            <?php unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <strong>Error:</strong> <?= $_SESSION['error']; ?>
                            <?php unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>
                    </div>
                
                    <form class="space-y-6" action="Includes/contactUs.inc.php" method= "post" >
                        <div>
                            <label for="name" class="block text-gray-700 mb-2">Your Name</label>
                            <input type="text" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500"
                            name="name" required>
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 mb-2">Email Address</label>
                            <input type="email" name ="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                        </div>
                        <div>
                            <label for="message" class="block text-gray-700 mb-2">Your Message</label>
                            <textarea id="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500" name="message"></textarea>
                        </div>
                        <button type="submit" class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition-colors duration-300 w-full">
                            <i class="fas fa-paper-plane mr-2"></i> Send Message
                        </button>
                    </form>
                </div>
                
                <div class="animate-slide" style="animation-delay: 0.3s;">
                    <div class="bg-gray-50 rounded-xl p-8 h-full">
                        <h3 class="text-xl font-semibold mb-6 text-gray-800">Contact Information</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-2xl text-gray-700 mt-1 mr-4"></i>
                                <div>
                                    <h4 class="font-medium text-gray-800">Address</h4>
                                    <p class="text-gray-600">123 Education Street, Dar es Salaam, Tanzania</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <i class="fas fa-phone-alt text-2xl text-gray-700 mt-1 mr-4"></i>
                                <div>
                                    <h4 class="font-medium text-gray-800">Phone</h4>
                                    <p class="text-gray-600">+255 774 603 657</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <i class="fas fa-envelope text-2xl text-gray-700 mt-1 mr-4"></i>
                                <div>
                                    <h4 class="font-medium text-gray-800">Email</h4>
                                    <p class="text-gray-600">info@hsfamis.ac.tz</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <i class="fas fa-clock text-2xl text-gray-700 mt-1 mr-4"></i>
                                <div>
                                    <h4 class="font-medium text-gray-800">Working Hours</h4>
                                    <p class="text-gray-600">Monday - Friday: 8:00 AM - 5:00 PM</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <h4 class="font-medium text-gray-800 mb-4">Follow Us</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-300 transition-colors duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-300 transition-colors duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-300 transition-colors duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-300 transition-colors duration-300">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="animate-slide" style="animation-delay: 0.1s;">
                    <div class="flex items-center mb-4">
                        <img src="hsfamis-logo.jpg" alt="HSFAMIS Logo" class="h-8 mr-2">
                    </div>
                    <p class="mb-4">
                        Empowering students through practical field training experiences in Tanzania.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div class="animate-slide" style="animation-delay: 0.2s;">
                    <h4 class="text-lg font-semibold text-white mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="hover:text-white transition-colors duration-300">Home</a></li>
                        <li><a href="#programs" class="hover:text-white transition-colors duration-300">Programs</a></li>
                        <li><a href="#process" class="hover:text-white transition-colors duration-300">Application Process</a></li>
                        <li><a href="#contact" class="hover:text-white transition-colors duration-300">Contact</a></li>
                    </ul>
                </div>
                
                <div class="animate-slide" style="animation-delay: 0.3s;">
                    <h4 class="text-lg font-semibold text-white mb-4">Programs</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Technology</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Business</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Science</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">All Programs</a></li>
                    </ul>
                </div>
                
                <div class="animate-slide" style="animation-delay: 0.4s;">
                    <h4 class="text-lg font-semibold text-white mb-4">Newsletter</h4>
                    <p class="mb-4">
                        Subscribe to our newsletter for updates and announcements.
                    </p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 w-full rounded-l-lg focus:outline-none bg-gray-800 text-white">
                        <button type="submit" class="bg-gray-700 text-white px-4 rounded-r-lg hover:bg-gray-600 transition-colors duration-300">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 text-center animate-slide" style="animation-delay: 0.5s;">
                <p>&copy; 2023 HSFAMIS Field Training Program. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#home" class="fixed bottom-6 right-6 bg-gray-800 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-gray-700 transition-colors duration-300 z-50">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll animations
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.animate-slide, .animate-fade');
                const windowHeight = window.innerHeight;
                
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const elementVisible = 100;
                    
                    if (elementPosition < windowHeight - elementVisible) {
                        element.style.opacity = '1';
                        if (element.classList.contains('animate-slide')) {
                            element.style.transform = 'translateY(0)';
                        }
                    }
                });
            };
            
            window.addEventListener('scroll', animateOnScroll);
            animateOnScroll(); // Run once on page load
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            const alerts = document.getElementById('alerts');
        if (alerts) {
            setTimeout(() => {
                alerts.style.display = 'none';
            }, 7000); 
        }
            
            // Mobile menu toggle (would need implementation)
            const mobileMenuButton = document.querySelector('.md\\:hidden');
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    // Implement mobile menu toggle functionality
                    console.log('Mobile menu clicked - implement toggle functionality');
                });
            }
            
            // Preload the background image
            const bgImage = new Image();
            bgImage.src = '../images/field-training-tanzania.jpg';
            
            // Preload the logo
            const logo = new Image();
            logo.src = '../images/hsfamis-logo.jpg';
            
            // Signup button loading animation
            const signupButtons = [
                document.getElementById('signupBtn'),
                document.getElementById('heroSignupBtn'),
                document.getElementById('processSignupBtn')
            ];
            
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            signupButtons.forEach(button => {
                if (button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        // Show loading overlay
                        loadingOverlay.classList.add('active');
                        
                        // Redirect after 3 seconds
                        setTimeout(() => {
                            window.location.href = 'Signup.php';
                        }, 3000);
                    });
                }
            });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation Required | HSFAMIS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <!-- Loading Screen -->
    <div id="loading-screen">
        <div class="loading-spinner"></div>
    </div>

    <!-- Main Content -->
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8 mx-4">
        <div class="text-center mb-6">
            <img src="../images/hsfamis-logo.jpg" alt="HSFAMIS Logo" class="h-16 mx-auto mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Account Activation</h1>
        </div>
        
        <div class="text-center">
            <i class="fas fa-envelope text-5xl text-blue-500 mb-4"></i>
            <p class="text-gray-600 mb-6">Please check your email to activate your account.</p>
            <p class="text-gray-500 text-sm">Didn't receive the email? <a href="#" class="text-blue-600 hover:text-blue-800">Resend activation link</a></p>
        </div>
    </div>

    <script>
        // Handle any link clicks with loading screen
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.getAttribute('href') && !this.getAttribute('href').startsWith('#')) {
                    e.preventDefault();
                    
                    // Show loading screen
                    document.getElementById('loading-screen').style.display = 'flex';
                    
                    // Redirect after 4 seconds
                    setTimeout(() => {
                        window.location.href = this.href;
                    }, 4000);
                }
            });
        });
    </script>
</body>
</html>
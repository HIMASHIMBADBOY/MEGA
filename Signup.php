<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | Bebrilliant</title>
    <link rel="stylesheet" href="Assets/bootstrap.min.css">
    <link rel="stylesheet" href="Assets/style (2).css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
</head>
<body>
    <!---header logo    ---->
    <!-- <div class="logo">
        <img src="images/WhatsApp Image 2024-11-23 at 00.36.05.jpeg" alt="" class="img-fluid"  id= "img-logo">
    </div> -->
               
    <!---main container    ---->
     <div class="container d-flex justify-content-center align-items-center min-vh-100">
   
     


    <!---Login container    ---->
    <div class="row border rounded-5 p-3 bg-white shadow box-area" id="lfr-rt-bk-con">




     <!---left box    ---->
    <div class="col-md-6 rounded-4 d-flex justify-content-center align-content-center flex-column left-box " id= "lft-box">
        <div class="featured-image mb-3">
            <img src="images/debby-hudson-asviIGR3CPE-unsplash.jpg"  class="img-fluid"style="width:500px;" id= "rt-img">
        </div>
        <p class= "text-black fs-2 text-left" style= "font-weight: 600;">Be Educated</p>
        <small class= "text-black text-wrap text-left" style="width:17rem;">join now to get full access of studies in this platform.</small>
    </div>






    <!---Right box    ---->
    
    <div class="col-md-6 right-box">
 <?php
        // Check for error messages in the session
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']); // Clear the error message after displaying it
        }
        ?>
    <form action="includes/signup.inc.php" method="post">
       <div class="row align-items-center">
        <h3>Hello,Again</h3>
        <p style="font-weight:600">We help you ease your learning process</p>
       </div> 
      
       <div class="input-group  mb-1">
        <input type="text" name="uid" id="" class="form-control form-control-lg bg-light fs-6" placeholder="Username">
       </div>

       <div class="input-group mb-1">
        <input type="email" name="email" id="" class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
       </div>

       <div class="input-group mb-1">
        <input type="password" name="pwd" id="" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
       </div>

       <div class="input-group mb-1">
        <input type="password" name="rpwd" id="" class="form-control form-control-lg bg-light fs-6" placeholder="Repeat Password">
       </div>

       <div class="input-group mb-5 d-flex justify-content-between">
         <div class="form-check">
            <select name="user_role" id="">
               <option value="student">Student</option>
               <option value="admin">Admin</option>
            </select>
            <label for="formcheck" class="form-check-label text-secondary"><small>What's your role?</small></label>
         </div>
        </div>

       <!-- <div class="input-group mb-5 d-flex justify-content-between">
         <div class="form-check">
            <input type="checkbox" name="" id="">
            <label for="formcheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
         </div>
        </div> -->

       

       <div class="input-group mb-3">
        <button type="submit" name="submit" class="btn btn-lg btn-primary w-100 fs-6">Sign Up</button>
       </div>

       <div class="input-group mb-3">
        <a href="Signin.php"><button type="submit" class="btn btn-lg  w-100 fs-6" id="btn-g"></a>
            <img src="images/yui.png" alt="" style="width:30px" class="me-2">
            <small>Sign Up with Google</small>
        </button>
       </div>
       <div class="row " >
            <small class="text-center">Have an account already? <a href="Signin.php">Sign in Now</a></small>
        </div>
    

         </div>
       </form>
    </div>


</body>
</html>
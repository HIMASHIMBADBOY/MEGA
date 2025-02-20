<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Brilliant</title>
</head>
<body>

    <?php
    // Check for error messages in the session
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']); // Clear the error message after displaying it
    }
    ?>

  
    <form action="includes/login.inc.php" method="post" >
        <h3>Hello, Again</h3>

        <p style="font-weight:600">We help you ease your learning process</p>
       

       
        <input type="text" name="user_uid" id="" class="form-control form-control-lg bg-light fs-6" placeholder="Username"><br>
       


       
        <input type="password" name="user_pwd" id="" class="form-control form-control-lg bg-light fs-6" placeholder="Password"><br>
     
     
            <input type="checkbox" name="" id="">
            <label for="formcheck" class="form-check-label text-secondary"><small>Remember Me</small></label><br>
       

         
            <small><a href="#">Forgot password?</a></small><br>
        

       
        <button type="submit" class="btn btn-lg btn-primary w-100 fs-6" name="submit">Sign In</button><br>
  
 
        <button type="submit" class="btn btn-lg  w-100 fs-6" id="btn-g">
            <small>Sign in with Google</small>
        </button><br>       
            <small class="text-center">Don't have an account? <a href="Signup.php">Register Now</a></small>        
         </form>


</body>
</html>

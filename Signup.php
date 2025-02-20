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
  
    <form action="includes/signup.inc.php" method="post" >
        <h3>Hello,Again</h3>
        <p style="font-weight:600">We help you ease your learning process</p>
           
        <input type="text" name="uid" id="" class="form-control form-control-lg bg-light fs-6" placeholder="Username"><br>

        <input type="text" name="email" id="" class="form-control form-control-lg bg-light fs-6" placeholder="email"><br>
       
        <input type="password" name="pwd" id="" class="form-control form-control-lg bg-light fs-6" placeholder="Password"><br>
     
        <input type="password" name="rpwd" id="" class="form-control form-control-lg bg-light fs-6" placeholder="repeat Password"><br>
     
        <select name="user_role" id="">
               <option value="student">Student</option>
               <option value="admin">Admin</option>
            </select>
            <label for="formcheck" class="form-check-label text-secondary"><small>What's your role?</small></label>
       

         
            <small><a href="#">Forgot password?</a></small><br>
        

       
        <button type="submit" class="btn btn-lg btn-primary w-100 fs-6" name="submit">Sign In</button><br>
  
 
        <button type="submit" class="btn btn-lg  w-100 fs-6" id="btn-g">
            <small>Sign in with Google</small>
        </button><br>       
            <small class="text-center">have an account? <a href="Signin.php">Signin Now</a></small>        
         </form>


</body>
</html>
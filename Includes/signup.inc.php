<?php
require "../Config/functions.php";
if(session_status() === PHP_SESSION_NONE){
 session_start(); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//grabbing the data
$uid = sanitize_input($_POST['uid']);
$email = sanitize_input($_POST['email']);
$pwd = sanitize_input($_POST['pwd']);
$rpwd = sanitize_input($_POST['rpwd']);
$role = sanitize_input($_POST['user_role']);
$_SESSION['signup-uid'] = $uid;
$_SESSION['signup-email'] = $email;

//creating an activation token using random characters
$activation_token = bin2hex(random_bytes(16));
$activation_token_hash = hash("sha256", $activation_token);
$_SESSION['activation_token'] = $activation_token;

//instantiate signupContr class
require_once '../Config/dbh.classes.php';
require_once '../Models/signup.classes.php';
require_once '../Controllers/signup-contr.classes.php';

$signup = new SignupContr($uid, $email, $pwd, $rpwd, 
$role, $activation_token_hash);

//error handling 
$signup->signupUser();


//sending back the user to the login page
redirect("emailConfirmation.inc.php?error=none");

}

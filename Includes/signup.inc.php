<?php
require "../Config/functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//grabbing the data
$uid = sanitize_input($_POST['uid']);
$email = sanitize_input($_POST['email']);
$pwd = sanitize_input($_POST['pwd']);
$rpwd = sanitize_input($_POST['rpwd']);
$role = sanitize_input($_POST['user_role']);
 
//instantiate signupcontr class
require_once '../Config/dbh.classes.php';
require_once '../Models/signup.classes.php';
require_once '../Controllers/signup-contr.classes.php';

$signup = new SignupContr($uid, $email, $pwd, $rpwd, 
$role);

//error handling 
$signup->signupUser();


//sending back the user to the login page
redirect("../Signin.php?error=none");

}
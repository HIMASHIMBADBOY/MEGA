<?php
session_start();
require "../Config/functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//grabbing the data
$uid = sanitize_input($_POST['user_uid']);
$pwd = sanitize_input($_POST['user_pwd']);

 
//instantiate signupcontr class
require_once '../Config/dbh.classes.php';
require_once '../Models/login.classes.php';
require_once '../Controllers/login-contr.classes.php';

$login = new LoginContr($uid, $pwd);

//error handling 
$login->LoginUser();

//sending back the user to the dashboard page

if($_SESSION['userrole']==='admin'){
    redirect("../Views/Admins/dashboard.view.php");
 }else{
     redirect("Student.inc.php");
 }

}
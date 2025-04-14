<?php
if(session_status() == PHP_SESSION_NONE){
 session_start();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
 
 $token = $_POST['token'] ?? null;
 $pwd = $_POST['newPassword'] ?? null;
 $rpwd = $_POST['confirmPassword'] ?? null;
 $email = $_SESSION['userEmail'] ?? null;
 //hash the token 
 $token_hash = hash("sha256", $token);
 
 //check if the token is valid
 require_once "../Config/functions.php";
 require_once "../Config/dbh.classes.php";
 require_once "../Models/passwordUpdates.classes.php";
 require_once "../Controllers/newPassword-contr.class.php";

 $token_verify = new Password();
 if($token_verify->checkToken($token_hash)){
     $newPassword = new newPassword($pwd, $rpwd, $email);
     $newPassword->getNewPwd($pwd, $rpwd, $email); 
 }
}
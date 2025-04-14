<?php
if(session_status() == PHP_SESSION_NONE){
session_start();
}
require_once "../Config/functions.php";
require_once "../Config/dbh.classes.php";
require_once "../Models/passwordUpdates.classes.php";
require_once "../Controllers/forgotPassword-contr.classes.php";


$email = $_POST['email'];
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$insertToken = new forgotPassword($email, $token_hash, $expiry);
$insertToken->getNewPwd($email, $token_hash, $expiry);

//store the token in session for later use
$_SESSION['userToken'] = $token;
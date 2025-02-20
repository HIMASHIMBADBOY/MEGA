<?php
function is_admin(){
    if (isset($_SESSION['role'] )&& $_SESSION['role'] == 'admin'){
        return true;
    }
       return false;
}

function is_student(){
    if (isset($_SESSION['role'] )&& $_SESSION['role'] == 'student'){
        return true;
    }
       return false;
}

function redirect($url){
    header("location:" . $url);
}

function hash_password($password){
    return password_hash($password, PASSWORD_BCRYPT);
}

function verify_password($password, $hashed_password){
    return password_verify($password, $hashed_password);
}

function sanitize_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function handleError(Exception $e) {
    redirect("../index.php?error=" . urlencode($e->getMessage()));
    exit();
}
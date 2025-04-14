<?php
if(session_status() == PHP_SESSION_NONE){
 session_start();
}

class Password extends Db {

 protected function forgotPwd($email, $token_hash, $expiry){
 $stmt = $this->connection()->prepare("UPDATE users 
 SET reset_token_hash = ?,
     reset_token_expires_at = ? WHERE user_email = ?");
 if($stmt->execute([$token_hash, $expiry, $email])){
   $_SESSION['userEmail'] = $email;
   redirect("../includes/resetPassword.inc.php");
 } 
 
 }

 protected function updatePwd($pwd, $email){
  $password_hash = password_hash($pwd, PASSWORD_DEFAULT);

  $stmt = $this->connection()->prepare("UPDATE users
  SET user_pwd = ?,
  reset_token_hash = NULL,
  reset_token_expires_at = NULL
  WHERE user_email = ?;");
  if(!$stmt->execute([$password_hash, $email])){
   $_SESSION['error'] = 'Password not Updated';
   redirect("../resetPassword.php?passwordNotUpdated");
   exit();
  }else{
   
   $stmt = null;
   session_unset();
   session_destroy();
   redirect("../resetPasswordSuccess.php");
  }
    }

 protected function checkUser($email){
  $stmt= $this->connection()->prepare('SELECT user_email FROM users WHERE user_email = ?;');
  if(!$stmt->execute(array($email))){
      $stmt= null;
      $_SESSION['error'] = 'failed to fetch email, please try again';
      header("location:../forgot-password.php");
      exit();
  }
  
    $resultcheck;
  if( $stmt->rowcount() > 0){
      $resultcheck = true;
  }else{
  
      $resultcheck = false;
  }
   return $resultcheck;
  }

  
  public function checkToken($token_hash) {
   $stmt = $this->connection()->prepare("SELECT * FROM users WHERE reset_token_hash = ?");
   
  
   if (!$stmt->execute([$token_hash])) {
       $_SESSION['error'] = 'Failed to execute query.';
       header("location:../reset-password.php");
       exit();
   }

   // Fetch the result
   $result = $stmt->fetch(PDO::FETCH_ASSOC);

   
   if (!$result) {
       $_SESSION['error'] = 'Token not found.';
       header("location:../reset-password.php");
       exit();
   }

  
   if (strtotime($result['reset_token_expires_at']) <= time()) {
       $_SESSION['error'] = 'Token expired.';
       header("location:../reset-password.php?tokenExpired");
       exit();
   }

   
   return $result;
}

}
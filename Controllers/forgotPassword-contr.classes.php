<?php

class forgotPassword extends Password {
 private $email; 
 private $token_hash; 
 private $expriy; 

 public function __construct($email, $token_hash, $expriy){
 $this->email = $email;
 $this->token_hash = $token_hash;
 $this->expriy = $expriy;
 }
 
 public function getNewPwd(){
      if($this->noEmailFound() == false){
       $_SESSION['error'] = 'Email not Found';
       redirect("../forgot-password.php?noEmailfound");
      }

  try {
   $this->forgotPwd($this->email, $this->token_hash, $this->expriy);
  } catch (Exception $e) {
   throw new Exception("Error Reaching the database:" . $e->getMessage());
  }
 }

 private function noEmailFound() {
  if ($this->checkUser($this->email)) {
      return true;
  }
  return false;
}
 

}
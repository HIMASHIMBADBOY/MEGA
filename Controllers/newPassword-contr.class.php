<?php

class newPassword extends Password{
 private $pwd;
 private $rpwd;
 private $email;

 public function __construct($pwd, $rpwd, $email){
  $this->pwd = $pwd;
  $this->rpwd = $rpwd;
  $this->email = $email;
 }

 public function getNewPwd(){

  if($this->validatePwd() == false){
      $_SESSION['error'] = 'Password must be at least 8 characters long';
      redirect("../resetPassword.php?invalidPassword");
  }

  if($this->invalidPcfm() == false){
      $_SESSION['error'] = 'Password does not match';
      redirect("../resetPassword.php?passwordNotMatch");
  }

  try {
      $this->updatePwd($this->pwd, $this->email);
  } catch (Exception $e) {
      throw new Exception("Error Reaching the database:" . $e->getMessage());
  }

 }


 protected function validatePwd() {
  if (strlen($this->pwd) >= 8) {
      return true;
  }
  return false;
}


 protected function invalidPcfm() {
  $result; 
  if ($this->pwd !== $this->rpwd) {
      $result = false;
  } else {
      $result = true;
  }
  return $result; 
}

}
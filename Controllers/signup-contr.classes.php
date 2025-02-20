<?php
require_once "../Models/signup.classes.php";

class SignupContr extends Signup {
    private $uid;
    private $email;
    private $pwd;
    private $rpwd;
    private $role;

    public function __construct($uid, $email, $pwd, $rpwd, $role) {
        $this->uid = $uid;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->rpwd = $rpwd;
        $this->role = $role;
    }

    public function SignupUser() {
        if ($this->emptyInput() == false) {
            
            header("location:../index.php");
            exit();
        }
        if ($this->invalidEmail() == false) {
             
            header("location:../index.php");
            exit();
        }
        if ($this->invalidPcfm() == false) {
          
            header("location:../index.php?error=notmatch");
            exit();
        }

        $this->setUser($this->uid, $this->email, $this->pwd, $this->role);
    }

    protected function emptyInput() {
        $result; 
        if (empty($this->uid) || empty($this->email) || empty($this->pwd) || empty($this->rpwd)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result; 
    }

    protected function invalidEmail() {
        $result; 
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result; 
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

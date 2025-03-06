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
            $_SESSION['error'] = 'All fields are required';
            header("location:../Signup.php?error=emptyinput");
            exit();
        }
        
        if ($this->validateUid() == false) {
            $_SESSION['error'] = 'Invalid Username';
            header("location:../Signup.php?error=invaliduid");
            exit();
        }

        if ($this->validatePwd() == false) {
            $_SESSION['error'] = 'Invalid Username';
            header("location:../Signup.php?error=invalidpwd");
            exit();
        }

        if ($this->invalidEmail() == false) {
            $_SESSION['error'] = 'Invalid Email';
            header("location:../Signup.php?error=invalidemail");
            exit();
        }

        if ($this->invalidPcfm() == false) {
            $_SESSION['error'] = 'Password not match';
            header("location:../Signup.php?error=notmactch");
            exit();
        }

        if ($this->UsernameTaken() == true) {
            $_SESSION['error'] = 'Password not match';
            header("location:../Signup.php?error=uidtaken");
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

    protected function validatePwd() {
        if (strlen($this->pwd) >= 8) {
            return true;
        }
        return false;
    }

    protected function validateUid() {
        if (preg_match("/^[a-zA-Z0-9]*$/", $this->uid) && strlen($this->uid) >= 4) {
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

    protected function UsernameTaken() {
        if ($this->checkUser($this->uid)) {
            return true;
        }
        return false;
    }

}

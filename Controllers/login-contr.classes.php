<?php
require_once "../Models/login.classes.php";

class LoginContr extends Login {
    private $uid;
    private $pwd;

    public function __construct($uid, $pwd) {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    public function LoginUser() {
        if ($this->emptyInput() == false) {
            $_SESSION['error'] = "Empty input"; // Set error message in session
            header("location:../Signin.php");
            exit();
        }
        if (!$this->validateInput($this->uid, $this->pwd)) {
            $_SESSION['error'] = "Invalid input"; // Set error message in session
            header("location:../Signin.php");
            exit();
        }

        $this->getUser($this->uid, $this->pwd); // Use plain password for verification
    }

    protected function emptyInput() {
        $result;
        if (empty($this->uid) || empty($this->pwd)) { 
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    protected function validateInput($uid, $pwd) {
        if (preg_match("/^[a-zA-Z0-9]*$/", $uid) && strlen($uid) >= 3 && strlen($pwd) >= 6) {
            return true;
        }
        return false;
    }
}

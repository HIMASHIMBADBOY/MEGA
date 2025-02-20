<?php
// This file is for all database-related stuff 
// like running a query inside the database, etc.
require_once "../Config/dbh.classes.php";

class Login extends Db{
    protected function getUser($uid, $pwd){
    
        $stmt= $this->connection()->prepare('SELECT user_pwd FROM users WHERE user_uid = ? OR user_email = ?;');

       
        if(!$stmt->execute(array($uid, $pwd))){
            $stmt= null;
            header("location:../index.php?error=stmtfailed");
            exit();
        
        }

        if($stmt->rowcount() == 0){
            $stmt= null;
            header("location:../index.php?error=usernotfound");
            exit();
        
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["user_pwd"]);
        if($checkPwd == false){
            $stmt= null;
            header("location:../index.php?error=Passowrd doesnt match");
            exit();
        }elseif($checkPwd == true){

            $stmt= $this->connection()->prepare('SELECT * FROM users WHERE user_uid = ? OR user_email = ? AND user_pwd = ?;');

        }

        if(!$stmt->execute(array($uid, $uid, $pwd))){
            $stmt= null;
            header("location:../index.php?error=stmtfailed");
            exit();
        
        }
        if($stmt->rowcount() == 0){
            $stmt= null;
            header("location:../index.php?error=usernotfound");
            exit();
        
        }
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["userid"] = $user[0]["user_id"];
        $_SESSION["useruid"] = $user[0]["user_uid"];
        $_SESSION["userrole"] = $user[0]["user_role"];
        $stmt= null;
    }

   





}
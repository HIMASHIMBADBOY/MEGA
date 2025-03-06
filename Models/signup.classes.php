<?php
// This file is for all database-related stuff 
// like running a query inside the database, etc.
require_once "../Config/dbh.classes.php";

//this file is for all database relates stuff 
//like running a query inside the database etx
class Signup extends Db {
    protected function setUser($uid, $email, $pwd, $role){
    
        $stmt= $this->connection()->prepare('INSERT INTO  users (user_uid, user_email, user_pwd, user_role) VALUES (?, ?, ?, ?);');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($uid, $email, $hashedPwd, $role))){
            $stmt= null;
            header("location:../index.php?error=stmtfailed");
            exit();
        
        }
        $stmt= null;
    }

 
protected function checkUser($uid){
$stmt= $this->connection()->prepare('SELECT user_uid FROM users WHERE user_uid = ?;');
#we put in the uid and the email as an array because we have more than one piece of data
if(!$stmt->execute(array($uid))){
    #deleting the statement entirely if it fails to execute
    $stmt= null;
    #creating a header function that is going to senf the user back to the frontindex page with an error message 
    header("location:../index.php");
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

protected function getUserId($uid){
    $stmt = $this->connection()->prepare('SELECT user_id FROM users WHERE user_uid = ?;');

    if(!$stmt->execute(array($uid))){
        $stmt = null;
        header("location: ../profile.php?error=stmtfailed");
        exit();
    }
    if($stmt->rowCount() == 0) {
        $stmt = null;
        header("location: ../profile.php?error=profilenotfound");
        exit();
    }
     $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $profileData;
   }
  







}

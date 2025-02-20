<?php

class Db{

    protected function connection(){
        $hostname='localhost';
        $db_name='test';
        $username='root';
        $password='';
        $dsn = "mysql:host=" . $hostname . ';dbname=' .  $db_name;

        try{
            $dbh =  new PDO ($dsn, $username, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbh;
      } catch(PDOException $e){
        echo 'the connection has failed :'.$e->getmessage();
        exit();
      }
      
    }
}
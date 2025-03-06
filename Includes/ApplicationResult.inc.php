<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once '../Config/functions.php';

 $user_id = $_SESSION['userid'] ?? null; // user id is stored in the session 

 if(is_student()){
    require_once '../Config/dbh.classes.php';
    require_once '../Models/Application.classes.php';
    require_once '../Controllers/applicationResults-contr.classes.php';

    

    try {
        $result_contr = new ApplicationResultContr(null, null, null);
        $result = $result_contr->getResultByid($user_id);
        
        // // Debugging output
        // echo '<pre>';
        // print_r($applications);
        // echo '</pre>';
        
        // Pass the applications to the view
        include '../Views/Students/ApplicationResult.view.php';
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

}

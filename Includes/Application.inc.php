<?php
// Start the session
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once '../Config/functions.php';

if(is_admin()){
    require_once '../Config/dbh.classes.php';
    require_once '../Models/Application.classes.php';
    require_once '../Controllers/applicationManage-contr.classes.php';

    

    try {
        $applicationManager = new ApplicationManageContr(null, null, null, null);
        $applications = $applicationManager->Applications();
        
        // // Debugging output
        // echo '<pre>';
        // print_r($applications);
        // echo '</pre>';
        
        // Pass the applications to the view
        include '../Views/Admins/applications.view.php';
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

}


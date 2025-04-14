<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once '../Config/functions.php';
 
if(is_admin()){
    require_once '../Config/dbh.classes.php';
    require_once '../Models/Application.classes.php';
    require_once '../Controllers/applicationManage-contr.classes.php';

    try {
        $applicationManager = new ApplicationManageContr(null, null, null, null, null, null);
        
        // Check if this is an AJAX request with search parameters
       
        // Regular page load
        $applications = $applicationManager->Applications();
        include '../Views/Admins/applications.view.php';
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
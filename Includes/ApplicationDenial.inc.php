<?php
// Start the session
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once '../Config/functions.php';

if(is_admin()){
    require_once '../Config/dbh.classes.php';
    require_once '../Models/Application.classes.php';
    require_once '../Controllers/statusApproval-contr.classes.php';

    

    try {
        $approvedapplicationManager = new statusApprovalContr(null, null, null, null, null);
        $approved = $approvedapplicationManager->showRejectedApplications();
        
        // // Debugging output
        // echo '<pre>';
        // print_r($applications);
        // echo '</pre>';
        
        // Pass the applications to the view
        include '../Views/Admins/rejectedApplications.view.php';
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

}


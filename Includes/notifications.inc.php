<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../Config/functions.php';
require_once '../Models/feedback.classes.php';
require_once '../Controllers/notifications-contr.classes.php';

// Retrieve user_id from session
$user_id = $_SESSION['userid'];

if ($user_id) {
    $notification = new feedbackContr(null, null, null);
    $notifications = $notification->getNotifications($user_id);
} else {
    $notifications = [];
}

//Pass the notifications to the view
include '../Views/Students/notifications.view.php';
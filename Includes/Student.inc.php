<?php
 // Start the session
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once '../Config/functions.php';
require_once '../Models/Field.classes.php';
require_once '../Controllers/field-contr.classes.php';

 // Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.inc.php"); // Redirect to login if not logged in
    exit();
}

// Create an instance of FieldContr
$fieldContr = new FieldContr(null, null, null); // Pass null values since we're only fetching data

// Fetch available fields
try {
    $fields = $fieldContr->ShowFields();
} catch (Exception $e) {
    $_SESSION['error'] = "Failed to fetch fields: " . $e->getMessage();
    $fields = []; // Set fields to an empty array if there's an error
}

// Include the view and pass the data
include '../Views/Students/fields.view.php';
?>
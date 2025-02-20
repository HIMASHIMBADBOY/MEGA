<?php
// session_start();
require_once '../Config/functions.php';
require_once '../Config/dbh.classes.php';
require_once '../Models/Field.classes.php';
require_once '../Controllers/field-contr.classes.php';



// Include the view and pass the data
include '../Views/Admins/dashboard.view.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST['field_name']);
    $description = sanitize_input($_POST['description']);
    $location = sanitize_input($_POST['location']);

 

    $fields = new FieldContr($name, $description, $location);

    //adding field
    try {
        $fields->newField();
        $success = "Field added successfully";
    } catch (Exception $e) {
        $error = "An error occurred: " . $e->getMessage();
    }
    $data = $fields->ShowFields();
    include '../Views/Admins/fields.view.php';
}


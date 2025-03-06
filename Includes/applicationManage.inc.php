<?php
// Start the session
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
require_once '../Config/functions.php';
require_once '../Models/Field.classes.php';
require_once '../Controllers/field-contr.classes.php';


// Check if field_id is provided in the URL
if (!isset($_GET['field_id'])) {
    $_SESSION['error'] = "No field selected.";
    header("../Views/Students/fields.view.php"); // Redirect back to fields page
    exit();
}

$field_id = $_GET['field_id'];
// Fetch field details
try {
    $fieldContr = new FieldContr(null, null, null); // Pass null values since we're only fetching data
    $field = $fieldContr->getFieldDetails($field_id); // Fetch field details by ID
} catch (Exception $e) {
    $_SESSION['error'] = "Failed to fetch field details: " . $e->getMessage();
    header("Location: ../Views/Students/fields.view.php"); // Redirect back to fields page
    exit();
}

// Pass the field details to the view
include '../Views/Students/apply.view.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $field_id = $_GET['field_id'] ?? null;
    $user_id = $_SESSION['userid'] ?? null; // user_id is stored in the session
    
    // Check if files are uploaded
    if (isset($_FILES['resume']) && isset($_FILES['cover_letter'])) {
        $resume = $_FILES['resume'];
        $cover_letter = $_FILES['cover_letter'];

        // Validate file types and sizes
        $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (in_array($resume['type'], $allowedTypes) && in_array($cover_letter['type'], $allowedTypes) &&
            $resume['size'] <= $maxFileSize && $cover_letter['size'] <= $maxFileSize) {

            // Move uploaded files to a permanent location
            $uploadDir = '../Uploads/';
            $resumePath = $uploadDir . basename($resume['name']);
            $coverLetterPath = $uploadDir . basename($cover_letter['name']);

            if (move_uploaded_file($resume['tmp_name'], $resumePath) && move_uploaded_file($cover_letter['tmp_name'], $coverLetterPath)) {
                // Include necessary files
                require_once '../Config/dbh.classes.php';
                require_once '../Models/Application.classes.php';
                require_once '../Controllers/application-contr.classes.php';

                // Create an instance of ApplicationContr
                $application = new ApplicationContr($field_id, $user_id, $resumePath, $coverLetterPath);

                try {
                    $application->Apply();
                    $_SESSION['success'] = "Application submitted successfully!";
                } catch (Exception $e) {
                    $_SESSION['error'] = "Error: " . $e->getMessage();
                }
            } else {
                $_SESSION['error'] = "Failed to upload files.";
            }
        } else {
            $_SESSION['error'] = "Invalid file type or size. Only PDF and Word documents up to 5MB are allowed.";
        }
    } else {
        $_SESSION['error'] = "Please upload both a resume and a cover letter.";
    }

    // Redirect back to the application page
    header("Location: ../../Views/Students/apply.view.php?field_id=$field_id");
    exit();
}

?>
<?php
require_once "../Config/dbh.classes.php";
require_once "../Models/Application.classes.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicationId = $_POST['applicationId'];
    $message = $_POST['message'];
    $confirmationLetter = $_FILES['confirmationLetter'];

    
    if (!$applicationId || !$message || !$confirmationLetter) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
        exit();
    }

    // Handle file upload
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . basename($confirmationLetter['name']);
    if (move_uploaded_file($confirmationLetter['tmp_name'], $uploadFile)) {
        // Save feedback to the database
        $application = new Application();
        $application->saveFeedback($applicationId, $message, $uploadFile);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload file.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
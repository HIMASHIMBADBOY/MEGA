<?php
require_once "../Config/dbh.classes.php";
require_once "../Models/Application.classes.php";
require_once "../Controllers/UpdateApplication-contr.classes.php";
header('Content-Type: application/json');

// Get the request data
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$status = $data['application_status'];

// Debugging output
error_log("ID: $id, Status: $status");

// Updating the application status
$updateStatus = new UpdApplicationContr($id, $status);
$updateStatus->updateStatus();

try {
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
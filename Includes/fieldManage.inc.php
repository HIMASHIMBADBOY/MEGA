<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../Config/functions.php';
require_once '../Config/dbh.classes.php';
require_once '../Models/Field.classes.php';
require_once '../Controllers/field-contr.classes.php';

// Check if the request is a JSON POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
    // Read the JSON input
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    // Check if the action key exists
    $action = isset($data['action']) ? sanitize_input($data['action']) : null;

    // Validate the input based on the action
    if ($action === 'edit' || $action === 'delete') {
        if (!isset($data['field_id'])) {
            echo json_encode(['success' => false, 'message' => 'Field ID is required for this action']);
            exit();
        }
    } elseif ($action === null || $action === 'add') {
        if (!isset($data['field_name'], $data['description'], $data['location'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid input for adding a field']);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        exit();
    }

    $admin_id = $_SESSION['userid'];
    $fields = new FieldContr($admin_id, $data['field_name'] ?? null, $data['description'] ?? null, $data['location'] ?? null);

    try {
        if ($action === 'edit') {
            // Handle edit action
            $field_id = sanitize_input($data['field_id']);
            $fields->editField($field_id, $data['field_name'], $data['description'], $data['location']);
            $updatedFields = $fields->showFieldByAdminId($admin_id);
            echo json_encode(['success' => true, 'message' => 'Field updated successfully', 'fields' => $updatedFields]);
        } elseif ($action === 'delete') {
            // Handle delete action
            $field_id = sanitize_input($data['field_id']);
            $fields->deleteField($field_id);
            $updatedFields = $fields->showFieldByAdminId($admin_id);
            echo json_encode(['success' => true, 'message' => 'Field deleted successfully', 'fields' => $updatedFields]);
        } else {
            // Handle add action (default)
            $fields->newField();
            $updatedFields = $fields->showFieldByAdminId($admin_id);
            echo json_encode(['success' => true, 'message' => 'Field added successfully', 'fields' => $updatedFields]);
            $_SESSION['field_id'] = $updatedFields[0]['field_id'];
            $_SESSION['field_name'] = $updatedFields[0]['field_name'];
        }
    } catch (Exception $e) {
        // Return error response
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit();
}
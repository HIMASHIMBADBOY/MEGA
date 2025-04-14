<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../models/Application.classes.php';
require_once '../controllers/applicationSearch-contr.classes.php';

$search = new searchContr();

if ($_SERVER['REQUEST_METHOD'] === 'GET') { 
    $searchTerm = $_GET['search'] ?? null;
    $statusFilter = $_GET['status'] ?? null;
    $dateFilter = $_GET['date'] ?? null;
    $sortOrder = $_GET['sort'] ?? 'ASC';

    try {
        $applications = $search->ApplicationsSearch($searchTerm, $statusFilter, $dateFilter, $sortOrder);

        header('Content-Type: application/json');
        echo json_encode($applications);
        exit;
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}

header('Content-Type: application/json');
echo json_encode(['error' => 'Invalid request method']);
exit;
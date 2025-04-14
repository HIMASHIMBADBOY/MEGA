<?php
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class searchContr extends Application {

 public function ApplicationsSearch($searchTerm, $statusFilter, $dateFilter, $sortOrder) {
  try {
      $application = $this->searchApplications($searchTerm, $statusFilter, $dateFilter, $sortOrder);
      return $application;
  } catch (Exception $e) {
      throw new Exception("Failed to fetch applications: " . $e->getMessage());
  }
}


}
<?php
require_once '../Config/functions.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

class ApplicationManageContr extends Application {
    private $field_id;
    private $user_id;
    private $application_status;
    private $resumee;
    private $cover_letter;
    private $submission_date;

    public function __construct($field_id, $user_id, $application_status, $resumee, $cover_letter, $submission_date) {
        $this->field_id = $field_id;
        $this->user_id = $user_id;
        $this->application_status = $application_status;
        $this->resumee = $resumee;
        $this->cover_letter = $cover_letter;
        $this->submission_date = $submission_date;
    }

     
    public function Applications(){
        $application;
        try {
            $application = $this->getApplicationsAdmin();
            return $application;
        } catch (Exception $e) {
            throw new Exception("failed to fetch the applications: " . $e->getMessage());
        }
    }
}

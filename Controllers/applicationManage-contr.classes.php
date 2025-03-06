<?php
require_once '../Config/functions.php';

class ApplicationManageContr extends Application {
    private $field_id;
    private $user_id;
    private $application_status;
    private $submission_date;

    public function __construct($field_id, $user_id, $application_status, $submission_date) {
        $this->field_id = $field_id;
        $this->user_id = $user_id;
        $this->$application_status = $application_status;
        $this->$submission_date = $submission_date;
    }

     
    public function Applications(){
        $application;
        try {
            $application = $this->getApplications();
            return $application;
        } catch (Exception $e) {
            throw new Exception("failed to fetch the applications: " . $e->getMessage());
        }
    }

}

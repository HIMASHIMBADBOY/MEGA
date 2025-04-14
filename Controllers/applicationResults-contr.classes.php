<?php
require_once '../Config/functions.php';

class ApplicationResultContr extends Application {
    private $field_name;
    private $submission_date;
    private $application_status;

    public function __construct($field_id, $submission_date, $application_status) {
        $this->field_id = $field_id;
        $this->application_status = $application_status;
        $this->submission_date = $submission_date;
    }

     
    public function getResultByid($user_id){
        $application;
        try {
            $application = $this->getApplicationResultById($user_id);
            return $application;
        } catch (Exception $e) {
            throw new Exception("failed to fetch the result of applications: " . $e->getMessage());
        }
    }

}

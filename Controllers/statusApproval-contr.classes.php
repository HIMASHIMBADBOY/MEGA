<?php
require_once "../Config/functions.php";
class statusApprovalContr extends Application {
    private $field_id;
    private $field_name;
    private $user_uid;
    private $user_email;
    private $application_status;
    private $resume;
    private $cover_letter;

    public function __construct($field_id, $field_name, $user_uid, $user_email, $application_status, $resume, $cover_letter) {
        $this->field_id = $field_id;
        $this->field_name = $field_name;
        $this->user_uid = $user_uid;
        $this->user_email = $user_email;
        $this->application_status = $application_status;
        $this->resume = $resume;
        $this->cover_letter = $cover_letter;
    }

     
    public function showApprovedApplications(){
        $application;
        try {
            $application = $this->getApplicationByApprovedStatus();
            return $application;
        } catch (Exception $e) {
            throw new Exception("failed to fetch the applications: " . $e->getMessage());
        }

    }

    public function showRejectedApplications(){
        $application;
        try {
            $application = $this->getApplicationByRejectedStatus();
            return $application;
        } catch (Exception $e) {
            throw new Exception("failed to fetch the applications: " . $e->getMessage());
        }

}

}
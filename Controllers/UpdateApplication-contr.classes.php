<?php
require_once "../Config/functions.php";

class UpdApplicationContr extends Application {
    private $id;
    private $status;

    public function __construct($id, $status){
        $this->id = $id;
        $this->status = $status;
        
    }

    public function updateStatus(){
            $update;
        try {
            $update = $this->updateApplicationStatus($this->id, $this->status);
        } catch (Exception $e) {
            throw new Exception("Failed to update status: " . $e->getMessage());
        }
    }


}
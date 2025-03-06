<?php
require_once "../Config/dbh.classes.php";

class Application extends Db {
    protected function addApplication($field_id, $user_id, $resume, $cover_letter) {
        $stmt = $this->connection()->prepare("INSERT INTO applications (field_id, user_id, resumee, cover_letter, application_status, submission_date) VALUES (:field_id, :user_id, :resumee, :cover_letter, 'pending', NOW())");
        $stmt->bindParam(':field_id', $field_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':resumee', $resume);
        $stmt->bindParam(':cover_letter', $cover_letter);
        return $stmt->execute();
    }

    protected function getApplications() {
        // Fetch applications from the database
        $sql = "SELECT * FROM applications";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getApplicationById($id) {
        $stmt = $this->connection()->prepare("SELECT * FROM applications WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function updateApplicationStatus($id, $status) {
        $sql = "UPDATE applications SET application_status = ? WHERE id = ?;";
        $stmt = $this->connection()->prepare($sql);
        $params = array($status, $id); // Corrected the order of parameters
        $stmt->execute($params);
        return $stmt->rowCount() > 0;
    }

    protected function getApplicationByApprovedStatus() {
        $stmt = $this->connection()->prepare("SELECT user_id, field_id, application_status, resumee, cover_letter FROM applications WHERE application_status = 'Approved'; ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function getApplicationByRejectedStatus() {
        $stmt = $this->connection()->prepare("SELECT user_id, field_id, application_status, resumee, cover_letter FROM applications WHERE application_status = 'Rejected'; ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function getApplicationResultById($user_id){
        $query = "SELECT 
        fields.field_name, applications.submission_date, applications.application_status
        FROM applications
        INNER JOIN fields
        ON applications.field_id=fields.field_id
        WHERE user_id= ?;";    
        $stmt = $this->connection()->prepare($query);
        $params= array($user_id);
        $stmt->execute($params);
        return $stmt->fetchAll();  
    }

}
?>
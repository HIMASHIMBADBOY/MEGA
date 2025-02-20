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

    protected function getApplicationById($id) {
        $stmt = $this->connection()->prepare("SELECT * FROM applications WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function updateApplicationStatus($id, $status) {
        $stmt = $this->connection()->prepare("UPDATE applications SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
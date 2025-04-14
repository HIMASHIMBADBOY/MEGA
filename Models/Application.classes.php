<?php
require_once "../Config/dbh.classes.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

class Application extends Db {
    protected function addApplication($field_id, $user_id, $resume, $cover_letter) {
        $stmt = $this->connection()->prepare("INSERT INTO applications (field_id, user_id, resumee, cover_letter, application_status, submission_date) VALUES (:field_id, :user_id, :resumee, :cover_letter, 'pending', NOW())");
        $stmt->bindParam(':field_id', $field_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':resumee', $resume);
        $stmt->bindParam(':cover_letter', $cover_letter);
         return $stmt->execute();
        // Return the application_id
       
    }

    protected function getApplications() {
        // admin Fetch applications from the database
        $sql = "SELECT * FROM applications";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getApplicationsAdmin() {
        $stmt = $this->connection()->prepare("SELECT * FROM fields WHERE admin_id =". $_SESSION['userid']);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
           // admin Fetch applications from the database
        $sql = "SELECT users.user_uid, applications.id, applications.application_status, applications.resumee, applications.cover_letter, applications.submission_date
        FROM applications
        INNER JOIN users ON applications.user_id=users.user_id
        WHERE field_id =". $result[0];//result 0 is the field id
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        //var_dump($results);
        return $results;
        }
    
       return [];
        
    }
    
    //shows the application selected by the student
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
        $query = "SELECT users.user_uid, applications.id, fields.field_name, applications.application_status, applications.resumee, applications.cover_letter FROM applications
        INNER JOIN users ON applications.user_id=users.user_id
        INNER JOIN fields ON applications.field_id=fields.field_id
        WHERE application_status = 'Approved';";
        $stmt = $this->connection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function getApplicationByRejectedStatus() {
        // $stmt = $this->connection()->prepare("SELECT user_id, field_id, application_status, resumee, cover_letter FROM applications WHERE application_status = 'Rejected'; ");
        $query = "SELECT users.user_uid, applications.id, fields.field_name, applications.application_status, applications.resumee, applications.cover_letter FROM applications
        INNER JOIN users ON applications.user_id=users.user_id
        INNER JOIN fields ON applications.field_id=fields.field_id
        WHERE application_status = 'Rejected';";
        $stmt = $this->connection()->prepare($query);
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

    //shows the username, fieldname, status, coverletter, resumee
    protected function getAllApplications(){
        $query = "SELECT users.user_uid, fields.field_name, applications.application_status, applications.resumee, applications.cover_letter FROM applications
        INNER JOIN users ON applications.user_id=users.user_id
        INNER JOIN fields ON applications.field_id=fields.field_id;";
        $stmt = $this->connection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
        }
      
        public function saveFeedback($applicationId, $message, $confirmationLetter) {
            $sql = "INSERT INTO feedbacks (application_id, message, confirmation_letter) VALUES (:application_id, :message, :confirmation_letter)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->bindParam(':application_id', $applicationId);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':confirmation_letter', $confirmationLetter);
            $stmt->execute();
        }

        // Add this new method to your Application class
     protected function searchApplications($searchTerm, $statusFilter, $dateFilter, $sortOrder) {
     $query = "SELECT users.user_uid, applications.id, applications.application_status, 
                     applications.resumee, applications.cover_letter, applications.submission_date
              FROM applications
              INNER JOIN users ON applications.user_id=users.user_id
              WHERE field_id = (SELECT field_id FROM fields WHERE admin_id = :admin_id)";
    
    $params = [':admin_id' => $_SESSION['userid']];
    
    // Add search term filter
    if (!empty($searchTerm)) {
        $query .= " AND (users.user_uid LIKE :searchTerm OR applications.application_status LIKE :searchTerm)";
        $params[':searchTerm'] = "%$searchTerm%";
    }
    
    // Add status filter
    if (!empty($statusFilter) && in_array($statusFilter, ['Approved', 'Rejected', 'pending'])) {
        $query .= " AND applications.application_status = :status";
        $params[':status'] = $statusFilter;
    }
    
    // Add date filter
    if (!empty($dateFilter)) {
        $query .= " AND DATE(applications.submission_date) = :dateFilter";
        $params[':dateFilter'] = $dateFilter;
    }
    
    // Add sorting
    $query .= " ORDER BY users.user_uid $sortOrder";
    
    $stmt = $this->connection()->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

        
    }
 

<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
require_once "../Config/dbh.classes.php";

class Field extends Db {
    //admin adding field according to the id
    protected function addField($admin_id, $name, $description, $location) {
        // Check if field name already exists
        $stmt = $this->connection()->prepare("SELECT * FROM fields WHERE field_name = ?");
        $stmt->execute([$name]);
        if ($stmt->fetch()) {
            throw new Exception("Field name already exists");
        }

        //check if admin has already added a field
        $stmt = $this->connection()->prepare("SELECT * FROM fields WHERE admin_id = ?");
        $stmt->execute([$admin_id]);
        if ($stmt->fetch()) {
            throw new Exception("Admin has already added a field");
        }

        // Proceed with inserting new field
        $query = "INSERT INTO fields (field_name, description, location, created_at, admin_id) VALUES(?, ?, ?, NOW(), ?)";
        $stmt = $this->connection()->prepare($query);
        $params = array($name, $description, $location, $admin_id);
        try {
            $result = $stmt->execute($params);
            if (!$result) {
                throw new Exception("Failed to add field");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
        $stmt = null;
        return true;
    }
    
    //student getting all the fields
    protected function getFields() {
        $stmt = $this->connection()->prepare("SELECT field_id, field_name, description, location FROM fields") ;
        $stmt->execute();
        $fields = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null; // Free up memory
        return $fields;
    }
     
    //admin getting the field by id
     protected function getFieldsByAdminId($admin_id){
        $stmt = $this->connection()->prepare("SELECT * FROM fields WHERE admin_id = ?");
        $params = array($admin_id);
        if (!$stmt->execute($params)) {
            $stmt = null;
            throw new Exception("Failed to fetch fields");
        }
        $fields = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null; // Free up memory
        return $fields;
     }
    
     //student getting the field details by the id of the field
    protected function getFieldsById($id) {
        $stmt = $this->connection()->prepare("SELECT field_name, description, location FROM fields WHERE field_id = ?");
        $params = array($id);
        if (!$stmt->execute($params)) {
            $stmt = null;
            throw new Exception("Failed to fetch field details.");
        }
        $field = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null; // Free up memory
        return $field;
    }

 //admin updating the field details
    protected function updateField($field_id, $name, $description, $location) {
        $query = "UPDATE fields SET field_name = ?, description = ?, location = ? WHERE field_id = ?";
        $stmt = $this->connection()->prepare($query);
        $params = [$name, $description, $location, $field_id];
        if (!$stmt->execute($params)) {
            throw new Exception("Failed to update field");
        }
    }
    
    //admin deleting the field
    protected function deleteFields($field_id) {
        $query = "DELETE FROM fields WHERE field_id = ?";
        $stmt = $this->connection()->prepare($query);
        if (!$stmt->execute([$field_id])) {
            throw new Exception("Failed to delete field");
        }
    }
}

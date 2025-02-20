<?php
require_once "../Config/dbh.classes.php";

class Field extends Db {
    protected function addField($name, $description, $location) {
        // Check if field name already exists
        $stmt = $this->connection()->prepare("SELECT * FROM fields WHERE field_name = ?");
        $stmt->execute([$name]);
        if ($stmt->fetch()) {
            throw new Exception("Field name already exists");
        }

        // Proceed with inserting new field
        $query = "INSERT INTO fields (field_name, description, location, created_at) VALUES(?, ?, ?, NOW())";
        $stmt = $this->connection()->prepare($query);
        $params = array($name, $description, $location);
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

    protected function getFields() {
        $stmt = $this->connection()->prepare("SELECT field_id, field_name, description, location FROM fields");
        $stmt->execute();
        $fields = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null; // Free up memory
        return $fields;
    }

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
    protected function deleteFields($id) {
        $stmt = $this->connection()->prepare("DELETE FROM fields WHERE field_id = ?");
        $params = array($id);
        if (!$stmt->execute($params)) {
            $stmt = null;
            throw new Exception("Failed to delete field");
        }
        return true;
    }
}
?>
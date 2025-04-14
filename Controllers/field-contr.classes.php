<?php
require_once '../Config/functions.php';
//ini_set('memory_limit', '2G');
class FieldContr extends Field {
    private $admin_id;
    private $name;
    private $description;
    private $location;

    public function __construct($admin_id, $name, $description, $location) {
        $this->admin_id = trim($admin_id);
        $this->name = trim($name);
        $this->description = trim($description);
        $this->location = trim($location);
    }
    
    //admin adding new field
    public function newField() {
        //var_dump($this->admin_id, $this->name, $this->description, $this->location);
        
        if ($this->emptyInput()) {
            redirect("../index.php?error=Emptyinput");
            exit();
        }
        try {
            $this->addField($this->admin_id, $this->name, $this->description, $this->location);
            $success = "Field added successfully";
        } catch (Exception $e) {
            if ($e->getMessage() === "Field name already exists") {
                $error = "Field name already exists. Please choose a different name.";
            } else {
                $error = "An error occurred: " . $e->getMessage();
            }
            // Handle error and display message to user
        }
    }

    //super admin getting all the fields or the student getting all the fields   
    public function ShowFields() {
        $fields;
        try {
            $fields = $this->getFields();
            return $fields;
        } catch (Exception $e) {
            throw new Exception("Failed to fetch fields: " . $e->getMessage());
        }
    }
    
    //admin getting the field by id
    public function showFieldByAdminId($admin_id) {
        $fields;
        try {
            $fields = $this->getFieldsByAdminId($admin_id);
            return $fields;
        } catch (Exception $e) {
            throw new Exception("Failed to fetch fields: " . $e->getMessage());
        }
    }
    
    //student getting the field details by the id
    public function getFieldDetails($id) {
        $field;
        try {
            $field = $this->getFieldsById($id);
            return $field;
        } catch (Exception $e) {
            throw new Exception("Failed to fetch field details: " . $e->getMessage());
        }
    
      }

      public function editField($field_id, $name, $description, $location) {
        try {
            $this->updateField($field_id, $name, $description, $location);
        } catch (Exception $e) {
            throw new Exception("Failed to update field: " . $e->getMessage());
        }
    }
    
    public function deleteField($field_id) {
        try {
            $this->deleteFields($field_id);
        } catch (Exception $e) {
            throw new Exception("Failed to delete field: " . $e->getMessage());
        }
    }

      //ensuring the input fields are not empty
    protected function emptyInput() {
        $result;
        if (empty($this->admin_id) ||empty($this->name) || empty($this->description) || empty($this->location)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
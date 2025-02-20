<?php
require_once '../Config/functions.php';
//ini_set('memory_limit', '2G');
class FieldContr extends Field {
    private $name;
    private $description;
    private $location;

    public function __construct($name, $description, $location) {
        $this->name = trim($name);
        $this->description = trim($description);
        $this->location = trim($location);
    }

    public function newField() {
        if ($this->emptyInput()) {
            redirect("../index.php?error=Emptyinput");
            exit();
        }
        try {
            $this->addField($this->name, $this->description, $this->location);
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

    public function ShowFields() {
        $fields;
        try {
            $fields = $this->getFields();
            return $fields;
        } catch (Exception $e) {
            throw new Exception("Failed to fetch fields: " . $e->getMessage());
        }
    }

    public function getFieldDetails($id) {
        $field;
        try {
            $field = $this->getFieldsById($id);
            return $field;
        } catch (Exception $e) {
            throw new Exception("Failed to fetch field details: " . $e->getMessage());
        }
    
      }
    protected function emptyInput() {
        $result;
        if (empty($this->name) || empty($this->description) || empty($this->location)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
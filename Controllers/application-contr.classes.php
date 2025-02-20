<?php
require_once '../Config/functions.php';

class ApplicationContr extends Application {
    private $field_id;
    private $user_id;
    private $resume;
    private $cover_letter;

    public function __construct($field_id, $user_id, $resume, $cover_letter) {
        $this->field_id = $field_id;
        $this->user_id = $user_id;
        $this->resume = $resume;
        $this->cover_letter = $cover_letter;
    }

    public function Apply() {
        if ($this->emptyInput()) {
            
            throw new Exception("All fields are required.");
            
        }

        try {
            $this->addApplication($this->field_id, $this->user_id, $this->resume, $this->cover_letter);
        } catch (Exception $e) {
            throw new Exception("Failed to submit application: " . $e->getMessage());
        }
    }

    protected function emptyInput() {
        return empty($this->field_id) || empty($this->user_id) || empty($this->resume) || empty($this->cover_letter);
    }
}
?>
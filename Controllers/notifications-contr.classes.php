<?php
 if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
class feedbackContr extends feedback {
  // private $field_id;
  private $user_id;
  private $message;
  private $cover_letter;

  public function __construct(/*$field_id,*/ $user_id, $message, $cover_letter){
    // $this->field_id = $field_id; 
    $this->user_id = $user_id; 
    $this->message = $message; 
    $this->cover_letter = $cover_letter; 
  }

  public function getNotifications($user_id){
    $result;
    try {
      $result = $this->getFeedback($user_id);
      return $result;
    } catch (Exception $e) {
      throw new Exception("Failed to fetch Notifications: " . $e->getMessage());
    }
  }
}


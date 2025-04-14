<?php
session_start();
require_once "../Config/functions.php";
require_once "../secret.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $name = sanitize_input($_POST['name']);
   $email = sanitize_input($_POST['email']);
   $message = sanitize_input($_POST['message']);
   
   if (empty($name) || empty($email) || empty($message)) {
    echo "All fields are required.";
    exit();
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address.";
    exit();
  }

  if (strlen($message) > 500) {
    echo "Message is too long. Maximum 500 characters.";
    exit();
  }

  try {
  $mail = require "../mailer.php";
  //from
  $mail->setFrom($email, $name);
  //to
  $mail->addAddress($username);
  $mail->Subject = "New Contact Us Message from $name";
  $mail->Body = "<p><strong>Name:</strong> $name</p>
                 <p><strong>Email:</strong> $email</p>
                 <p><strong>Message:</strong></p>
                 <p>$message</p>";


   if($mail->send()){
     $_SESSION['success'] = "Message sent successfully!";
     redirect("../index.php?success=1");
   }else{
     $_SESSION['error'] = "Failed to send message. Please try again later.";
     redirect("../index.php?error=1");
   }

  } catch (Exception $e) {
    echo "failed to send the message. mailer error: {$mail->ErrorInfo}";
    exit();
  }

 

}
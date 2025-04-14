<?php
// // Start the session
 if(session_status() === PHP_SESSION_NONE){
    session_start(); 
}
require_once "../config/functions.php";
// var_dump($_SESSION['email']);
$name = $_SESSION['signup-uid'];
$email = $_SESSION['signup-email'];
$url = 'http://localhost:8000/activate-account.php';
$activation_token = $_SESSION['activation_token'];
$mail = require '../mailer.php';
$mail->addAddress($email);
$mail->Subject = 'Your Account Is Almost Ready!';
$mail->Body = <<<END

                    <html>
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body>
                        <h1 style="color: black;">Hi! $name</h1>
                        <b>Thanks for signing up with HSFAMIS! To start using your account, please confirm your email address by clicking the link below:</b>
                        <br>
                        <a style ="color: seagreen;" href="$url?token=$activation_token">Activate Account</a>
                    </body>
                </html>
                END;
                try {
                 $mail->send();

                } catch (Exception $e) {
                 echo "message could not be sent. mailer error: {$mail->ErrorInfo}";
                 exit;
                }
                redirect("../activation.php");

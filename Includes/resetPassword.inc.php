<?php
if(session_status() == PHP_SESSION_NONE){
 session_start();
}

$mail = require_once "../mailer.php";
require_once "../secret.php";
require_once "../Config/functions.php";
$email = $_SESSION['userEmail'];
$url = "http://localhost:8000/resetPassword.php";
$token = $_SESSION['userToken'];
$mail->setFrom($username);
$mail->addAddress($email);
$mail->Subject = "Password Reset";
$mail->Body = <<<END
                 <html>
                      <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body>
                      <h1>Password Reset</h1>
                      <br>
                   <b>Click <a href="$url?token=$token">here</a> to reset Password</b>
                   </body>
                </html>
END;

try {
 $mail->send();

} catch (Exception $e) {
 echo "message could not be sent. mailer error: {$mail->ErrorInfo}";
 exit;
}
redirect("../reset-password.php");

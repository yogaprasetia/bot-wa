<?php

$email = $_GET['email'] ;
$name = $_GET['name'] ;
$subject = $_GET['subject'] ;
$body = $_GET['body'] ;


include "classes/class.phpmailer.php";
$mail = new PHPMailer; 
$mail->IsSMTP();
$mail->SMTPSecure = 'tls'; 
$mail->Host = "smtp.gmail.com";  
$mail->SMTPDebug = 2;
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = "xxxxxx@gmail.com";  
$mail->Password = "xxxxxx";  
$mail->SetFrom("xxxxxx@gmail.com","WA-GW Notification");  
$mail->Subject = $subject;  
$mail->AddAddress($email,$name );   
$mail->MsgHTML($body);
@$cek = $mail->Send() ;
if($cek==1) echo "Message has been sent";
else echo "Failed to sending message";
?>
  
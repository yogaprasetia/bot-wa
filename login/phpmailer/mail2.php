<?php
$email = $_GET['email'] ;
$msg = $_GET['msg'] ; 

include "classes/class.phpmailer.php";
$mail = new PHPMailer; 
$mail->IsSMTP();
$mail->SMTPSecure = 'tls'; 
$mail->Host = "smtp.gmail.com";  
$mail->SMTPDebug = 2;
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = "whatsappsendee@gmail.com";  
$mail->Password = "Ok@10002000";  
$mail->SetFrom("whatsappsendee@gmail.com","WhatsApp Sender Web Notification");  
$mail->Subject = "RETRIEVE PASSWORD TO LOGIN WGWEB";  
$mail->AddAddress($email,$nama );   
$mail->MsgHTML("$msg");
@$cek = $mail->Send() ;
if($cek==1) echo "Message has been sent";
else echo "Failed to sending message";
?>
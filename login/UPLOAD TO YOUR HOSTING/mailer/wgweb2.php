<?php
$email = $_GET['email'] ;
$msg = $_GET['msg'] ; 

$app = 'WA-GW' ;
$app =  $_GET['app'] ;
$judul = $app . ' Notification' ;

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
$mail->SetFrom("xxxxxx@gmail.com", $judul);   
$mail->Subject = "RETRIEVE PASSWORD TO LOGIN WGWEB";  
$mail->AddAddress($email,$nama );   
$mail->MsgHTML("$msg");
@$cek = $mail->Send() ;
if($cek==1) echo "Message has been sent";
else echo "Failed to sending message";
?>
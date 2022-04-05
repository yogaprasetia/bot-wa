<?php
include "../konfig.php";
 
//---- PARAMETER
@$token 	= $_POST['sender_id'] ;
@$wa_no 	= $_POST['to'];
@$wa_text 	= $_POST['message'] ;
@$url 		= '' ;
 
/* @$token 	= $_POST['token'] ;
@$wa_no 	= $_POST['no'];
@$wa_text 	= $_POST['text'] ;
@$url 		= $_POST['file'] ; */

if (@$wa_no . @$wa_text == '') { exit ; } 

//---- VALIDASI TOKEN
$id = '' ;
$hasil = mysqli_query($koneksi, "SELECT id FROM web_user WHERE concat(id,password) = '$token'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $id = $db['id'] ; }
if ( $id == '' ) { echo 'Invalid Token' ;  exit ;  }

//---- PREPARE FILE FROM URL
$wa_file = '' ; 
if ($url != '') {
	$nama 		= basename($url);
	$data 		= file_get_contents($url); 
	$new 		= "../uploaded/$nama";
	$wa_file	= $path_upload . $nama ;
	file_put_contents($new, $data);
}

//---- INSERT OUTBOX QUEU
$wa_media = '' ; 
if ($multi != 'yes') {	
	mysqli_query($koneksi,"INSERT into outbox (wa_mode, wa_no, wa_text, wa_media, wa_file) values('0','$wa_no','$wa_text','$wa_media', '$wa_file')");
} else {
	mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file) values('O', '$id', '0','$wa_no','$wa_text','$wa_media', '$wa_file')");
} 	
echo 'ok' ;
?>
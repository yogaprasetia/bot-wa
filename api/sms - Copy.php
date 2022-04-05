<?php
// SAMPLE : 
// http://localhost/wgweb/api/send.php?token=51&no=085692961782&text=tes&file=http://tpberp.com/home_files/proses.png
// http://localhost/wgweb/api/send.php?token=51&no=085692961782&text=text-only

include "../konfig.php";

//---- PARAMETER
@$token 	= $_GET['token'] ;
@$wa_no 	= $_GET['no'];
@$wa_text 	= $_GET['text'] ; 

if (@$wa_no . @$wa_text == '') { exit ; } 

//---- VALIDASI TOKEN
$id = '' ;
$hasil = mysqli_query($koneksi, "SELECT id FROM web_user WHERE concat(id,password) = '$token'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $id = $db['id'] ; }
if ( $id == '' ) { echo 'Invalid Token' ;  exit ;  }
 
//---- INSERT SMS OUTBOX QUEU
$wa_media = '' ; 
$wa_file = '' ;

if ($multi != 'yes') {	
	mysqli_query($koneksi,"INSERT into outbox (wa_mode, wa_no, wa_text, wa_media, wa_file) values('3','$wa_no','$wa_text','$wa_media', '$wa_file')");
} else {
	mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file) values('O', '$id', '3','$wa_no','$wa_text','$wa_media', '$wa_file')");
} 	
echo 'ok' ;
?>
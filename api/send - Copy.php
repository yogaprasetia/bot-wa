<?php
// SAMPLE : 
// http://localhost/wgweb/api/send.php?token=51&no=085692961782&text=tes&file=http://tpberp.com/home_files/proses.png
// http://localhost/wgweb/api/send.php?token=51&no=085692961782&text=text-only

include "../konfig.php";

//---- PARAMETER
@$token 	= $_GET['token'] ;
@$wa_no 	= $_GET['no'];
@$wa_text 	= $_GET['text'] ;
@$url 		= $_GET['file'] ;

if (@$wa_no . @$wa_text == '') { exit ; } 

//---- VALIDASI TOKEN
$id = '' ;
$hasil = mysqli_query($koneksi, "SELECT id FROM web_user WHERE concat(id,password) = '$token'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $id = $db['id'] ; }
if ( $id == '' ) { echo 'Invalid Token' ;  exit ;  }

//---- PREPARE FILE FROM URL
$wa_file = '' ; 
$nama  = '' ;
$wa_file0 = '' ;

if ($url != '') {
	$nama 		= basename($url);
	$data 		= file_get_contents($url); 
	$new 		= "../uploaded/$nama";
	$wa_file0	= $path_upload . $nama ;	
	file_put_contents($new, $data);
}

//---- INSERT OUTBOX QUEU
if ( strtolower (substr($nama, -3)) == 'jpg' OR strtolower (substr($nama, -3)) == 'epg' OR strtolower (substr($nama, -3)) == 'png' )
{ $wa_media = $wa_file0 ;  $wa_file = '' ; }
else
{ $wa_media = '' ;    $wa_file  = $wa_file0 ; }

if ($multi != 'yes') {	
	mysqli_query($koneksi,"INSERT into outbox (wa_mode, wa_no, wa_text, wa_media, wa_file) values('0','$wa_no','$wa_text','$wa_media', '$wa_file')");
} else {
	mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file) values('O', '$id', '0','$wa_no','$wa_text','$wa_media', '$wa_file')");
} 	
echo 'ok' ;
?>
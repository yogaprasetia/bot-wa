<?php
include "../konfig.php";

//---- PARAMETER
@$token 	= $_GET['token'] ; 

//---- VALIDASI TOKEN
$id = '' ;
$hasil = mysqli_query($koneksi, "SELECT id FROM web_user WHERE concat(id,password) = '$token'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $id = $db['id'] ; }
if ( $id == '' ) { echo 'Invalid Token !' ;  exit ;  }

//---- SMS COUNT
$jml  = '0' ;
if ($multi != 'yes') {
$hasil = mysqli_query($koneksi, "select concat(id, '|', wa_no, '|', wa_text) sms from outbox where wa_mode = '3'   order by id LIMIT 1"  ) ;}
else{
$hasil = mysqli_query($koneksi, "select concat(id, '|', wa_no, '|', wa_text) sms from multi where  profil = '$id' and tipe = 'O'  and wa_mode = '3' order by id LIMIT 1"  ) ;}
$sms = '' ;
while ($db = mysqli_fetch_array($hasil))
{	$sms 		= $db['sms'] ;		 }
  
echo $sms  ;
?>
<?php
include "../konfig.php";

//---- PARAMETER
@$token 	= $_GET['token'] ; 

//---- VALIDASI TOKEN
$id = '' ;
$hasil = mysqli_query($koneksi, "SELECT id FROM web_user WHERE concat(id,password) = '$token'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $id = $db['id'] ; }
if ( $id == '' ) { echo '0' ;  exit ;  }

//---- SMS COUNT
$jml  = '0' ;
if ($multi != 'yes') {
$hasil = mysqli_query($koneksi, "select count(1) jml from outbox where wa_mode = '3'   order by id"  ) ;}
else{
$hasil = mysqli_query($koneksi, "select count(1) jml from multi where  profil = '$id' and tipe = 'O'  and wa_mode = '3' order by id"  ) ;}
 
while ($db = mysqli_fetch_array($hasil))
{	$jml 		= $db['jml'] ;		 }
  
echo $jml  ;
?>
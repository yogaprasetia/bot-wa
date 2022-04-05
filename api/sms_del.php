<?php
include "../konfig.php";

//---- PARAMETER
@$token	= $_GET['token'] ; 
@$idsms 	= $_GET['id'] ;

//---- VALIDASI TOKEN
$id = '' ;
$hasil = mysqli_query($koneksi, "SELECT id FROM web_user WHERE concat(id,password) = '$token'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $id = $db['id'] ; }
if ( $id == '' ) { echo 'Invalid Token !' ;  exit ;  }

//---- SMS COUNT
$jml  = '0' ;
if ($multi != 'yes') {
mysqli_query($koneksi, "delete from outbox where id = '$idsms' "    ) ;}
else{
mysqli_query($koneksi, "delete from multi where  id = '$idsms' "  ) ;}

 
 
?>
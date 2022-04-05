<?php
include "../konfig.php";

//---- PARAMETER
@$token 	= $_GET['token'] ; 

//---- VALIDASI TOKEN
$id = '' ;
$hasil = mysqli_query($koneksi, "SELECT id FROM web_user WHERE concat(id,password) = '$token'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $id = $db['id'] ; }
if ( $id == '' ) { echo 'Invalid Token !' ;  exit ;  }
  
echo $id  ;
?>
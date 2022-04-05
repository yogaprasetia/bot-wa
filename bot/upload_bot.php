
<?php 
include "../konfig.php"; 
?>
 
<?php
// upload file php
$target = basename($_FILES['filephp']['name']) ;
$tipe = $_FILES['filephp']['type'] ;
$nama = $_FILES['filephp']['name'];
$size = $_FILES['filephp']['size'];	
 
//move_uploaded_file($_FILES['filephp']['tmp_name'], $target);
move_uploaded_file($_FILES['filephp']['tmp_name'], '../bots/bot'.$profil.'.php') ;
  
// alihkan halaman ke index.php
header("location:index.php");
?> 
<?
include "../konfig.php";
@$id =  $_GET["id"] ;
 
mysqli_query($koneksi, "update web_user set status = 'Y' where id = '$id' " ) ;
 
header("Location:index.php");	 
?>
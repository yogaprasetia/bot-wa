<?
include "../konfig.php";
@$id =  $_GET["id"] ;
 
mysqli_query($koneksi, "delete from web_user where  wa_user <> 'demo' and id = '$id' " ) ;
 
header("Location:index.php");	 
?>
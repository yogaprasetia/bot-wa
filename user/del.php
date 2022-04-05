<?
include "../konfig.php";
if( $profil != 0 ) {echo "You don't have autority.." ; exit ; }

@$id =  $_GET["id"] ;
 
mysqli_query($koneksi, "delete from web_user where id = '$id' " ) ;
 
header("Location:index.php");	 
?>
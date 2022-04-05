<?
include "../konfig.php";
@$id =  $_GET["id"] ;
if( $profil != 0 ) {echo "You don't have autority.." ; exit ; }

mysqli_query($koneksi, "update web_user set status = 'Y' where id = '$id' " ) ;
 
header("Location:index.php");	 
?>
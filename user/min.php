<?
include "../konfig.php";
@$id =  $_GET["id"] ;

if( $profil != 0 ) {echo "You don't have autority.." ; exit ; }

mysqli_query($koneksi, "update web_user set expiry = DATE_ADD( COALESCE( DATE_FORMAT(expiry, '%Y-%m-%d'),  DATE_FORMAT(create_dt, '%Y-%m-%d')), INTERVAL -1 MONTH) where id = '$id' " ) ;
 
header("Location:index.php");	 
?>
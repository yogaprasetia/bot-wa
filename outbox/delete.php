<?
include "../konfig.php";
@$id =  $_GET["id"] ;

if ($multi != 'yes') {
mysqli_query($koneksi, "delete from outbox where id = '$id' "  ) ;
} else {
mysqli_query($koneksi, "delete from multi where id = '$id' and tipe = 'O'"  ) ;
}
header("Location:index.php");	 
?>
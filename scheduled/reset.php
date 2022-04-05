<?
include "../konfig.php";
$now = date('Y-m-d H:i:s') ; 
echo  "delete from outbox where wa_time > '$now'" ;
exit ;
if ($multi != 'yes') {
mysqli_query($koneksi, "delete from outbox where wa_time > '$now'"  ) ;
} else {
mysqli_query($koneksi, "delete from multi where profil = '$profil' and tipe = 'O' and wa_time > '$now' "  ) ;	
}
?> 
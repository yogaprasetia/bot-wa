<?
include "../konfig.php";
$now = date('Y-m-d H:i:s') ; 
 
if ($multi != 'yes') {
mysqli_query($koneksi, "delete from outbox where wa_mode = '3' "  ) ;
} else {
mysqli_query($koneksi, "delete from multi where wa_mode = '3' "  ) ;	
}
?> 
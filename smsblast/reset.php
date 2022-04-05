<?
include "../konfig.php";
mysqli_query($koneksi, "delete from multi where profil = '$profil' and tipe = 'D' and wa_mode = '3' order by id"  ) ;
?>
<?
include "../konfig.php";
mysqli_query($koneksi, "delete from multi where profil = '$profil' and tipe = 'D' order by id"  ) ;
?>
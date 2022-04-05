<?
include "../konfig.php";
mysqli_query($koneksi, "
INSERT INTO multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file, wa_time, id_outbox, status)
select 'O', profil, wa_mode, wa_no, wa_text, wa_media, wa_file, wa_time, id_outbox, status from multi where profil = '$profil' and tipe = 'D' and wa_mode = '3' order by id 
");
 
mysqli_query($koneksi, "delete from multi where profil = '$profil' and tipe = 'D' and wa_mode = '3' order by id"  ) ;
?>
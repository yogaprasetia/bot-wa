<?
include "../konfig.php";
$wa_no = $_POST["wa_no"]  ;
$wa_text = $_POST["wa_text"]  ; 

$wa_media = '' ;
$wa_file = '' ;

if ($multi != 'yes') {	
	mysqli_query($koneksi,"INSERT into outbox (wa_mode, wa_no, wa_text, wa_media, wa_file) values('9','$wa_no','$wa_text','$wa_media', '$wa_file')");
} else {
	mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file) values('O', '$profil', '9','$wa_no','$wa_text','$wa_media', '$wa_file')");
} 	
echo '<script>alert("Message insert into Outbox Queu..") ; </script>' ;	
header("Location:index.php?ok=yes");

?>
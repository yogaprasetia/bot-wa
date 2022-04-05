<?
include "../konfig.php"; 

if ($no_wagent != 'Y' ) {
	mysqli_query($koneksi, "insert into tmp (tmp_cd) VALUES ('off$profil00') ") ;
	mysqli_query($koneksi, "update web_user set qr = '' where id='$profil'") ;
	mysqli_query($koneksi, "delete from tmp where tmp_cd = 'status$profil00'") ; 
} else
{
	mysqli_query($koneksi, "update web_user set qr = '' where id='$profil'") ;
	mysqli_query($koneksi, "delete from tmp where tmp_cd = 'status$profil00'") ; 	
	$commandString = 'taskkill /F /IM wg.exe /FI "WINDOWTITLE eq ['. $profil . ']"'    ;
	pclose(popen($commandString, 'r'));	
}
?>
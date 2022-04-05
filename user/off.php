<?
include "../konfig.php";
if( $profil != 0 ) {echo "You don't have autority.." ; exit ; }

@$profil =  $_GET["id"] ;
@$profil00 =  $_GET["id00"] ;

/* mysqli_query($koneksi, "insert into tmp (tmp_cd) VALUES ('off$id00') ") ;
mysqli_query($koneksi, "update web_user set qr = '' where id='$id'") ;
mysqli_query($koneksi, "delete from tmp where tmp_cd = 'status$id00'") ; */ 

	mysqli_query($koneksi, "update web_user set qr = '' where id='$profil'") ;
	mysqli_query($koneksi, "delete from tmp where tmp_cd = 'status$profil00'") ; 	
	$commandString = 'taskkill /F /IM wg.exe /FI "WINDOWTITLE eq ['. $profil . ']"'    ;
	pclose(popen($commandString, 'r'));	
 
header("Location:index.php");
 

?>
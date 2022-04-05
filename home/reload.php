<?
include "../konfig.php";

if ($multi == 'yes') 
{ 
	if ($no_wagent != 'Y' ) {
		$hasil = mysqli_query($koneksi, "SELECT count(1) jml FROM tmp WHERE tmp_cd = 'status$profil00'"  )  ;
		while ($db = mysqli_fetch_array($hasil)) { $jml = $db['jml'] ; }
		if ( $jml == 0 ) 
		{   mysqli_query($koneksi, "delete from tmp where tmp_cd = 'off$profil00'") ;
			mysqli_query($koneksi, "insert into tmp (tmp_cd) VALUES ('on$profil00') ") ;
		}		
		else 
		{ 
			mysqli_query($koneksi, "insert into tmp (tmp_cd) VALUES ('off$profil00') ") ;
		//	sleep 7 ;
			mysqli_query($koneksi, "insert into tmp (tmp_cd) VALUES ('on$profil00') ") ;
		}
		mysqli_query($koneksi, "update web_user set qr = 'wait' where id='$profil'") ; 
	}
	else 
	{
		mysqli_query($koneksi, "update web_user set qr = 'wait' where id='$profil'") ; 
		//$commandString = 'taskkill /F /IM wg.exe /FI "WINDOWTITLE eq ['. $profil . ']"'    ;
		//pclose(popen($commandString, 'r'));
		//sleep 2 ;
		$commandString = 'start /b c:\\wa-gw\app\wg.exe ' . $profil  ;
		pclose(popen($commandString, 'r'));
	
//		$WshShell = new COM("WScript.Shell");
//		$oExec = $WshShell->Run("C:/wa-gw/app/wg.exe ". $profil , 0, false);	
	}	
}
else
{
	mysqli_query($koneksi, "delete from tmp where tmp_cd = 'restart' ");    
	mysqli_query($koneksi, "insert into tmp (tmp_cd, tmp_val ) VALUES ('restart', 'yes' )"); 
}	
?>
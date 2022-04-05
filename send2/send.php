<?
include "../konfig.php";
$wa_no 		= $_POST["wa_no"]  ;
$wa_text 	= $_POST["wa_text"]  ; 
$tgl 		= $_POST["tgl"]  ; 
$jam 		= $_POST["jam"]  ; 
$wa_time  	= $tgl . ' ' . $jam ;
$tipe 		= substr($_FILES['file']['type'],0,5);
$nama 		= $_FILES['file']['name'];
$size 		= $_FILES['file']['size'];			

if ($tipe=='') {
	$wa_media = '' ;
	$wa_file = '' ;

	if ($multi != 'yes') {	
		mysqli_query($koneksi,"INSERT into outbox (wa_mode, wa_no, wa_text, wa_media, wa_file, wa_time) values('0','$wa_no','$wa_text','$wa_media', '$wa_file', '$wa_time')");
	} else {
		mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file, wa_time) values('O', '$profil', '0','$wa_no','$wa_text','$wa_media', '$wa_file', '$wa_time')");
	} 
	header("Location:index.php?ok=yes"); 
}	
 else
{
	if ($tipe =='image') {
	$wa_media = $path_upload . $nama ; $wa_file = '' ; }
	else {
		$wa_media = '' ; $wa_file =   $path_upload . $nama ;	
	}
 
	if(move_uploaded_file($_FILES['file']['tmp_name'], '../uploaded/'.$nama)) {	

			if ($multi != 'yes') {	
				mysqli_query($koneksi,"INSERT into outbox (wa_mode, wa_no, wa_text, wa_media, wa_file, wa_time) values('0','$wa_no','$wa_text','$wa_media', '$wa_file', '$wa_time' )");
			} else {
				mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file, wa_time) values('O', '$profil', '0','$wa_no','$wa_text','$wa_media', '$wa_file', '$wa_time' )");
			} 				
			header("Location:index.php?ok=yes");	 

	} else {
		echo "<script>alert('Not uploaded because of error #". $_FILES["file"]["error"] . "') ; 
		window.location.replace('index.php');</script>
		" ;		
		}
}
?>
<?php   
$_SESSION['profil'] = '0' ;

require_once ('../konfig.php') ;
$username = $_POST["username"]  ;
$userpass = $_POST["userpass"]  ; 

/* $username = 'aa'  ;
$userpass = '490'  */; 
 
 
if ($username=='admin' AND $userpass == $admin_password ) {  $_SESSION['profil'] = '0';	exit ;}
 
if ($multi == 'yes') {
	$query = mysqli_query($koneksi,"SELECT count(1) jml FROM web_user where wa_user = '$username' and password = '$userpass' ") ;
	while ($rs = mysqli_fetch_array($query))
	{$jml = $rs['jml'] ; }	

	if ($jml > 0  ) 
	{
	$query = mysqli_query($koneksi,"SELECT id FROM web_user where wa_user = '$username' and password = '$userpass' ") ;
	while ($rs = mysqli_fetch_array($query))
	{$profil = $rs['id'] ; }	
	 
	$_SESSION['profil'] = $profil;	 
	mysqli_query( $koneksi, "update web_user set last_login = sysdate() where id = '$profil'" ); 
	 } else { echo 'SALAH' ; }
} else 
{ echo 'SALAH' ; }	
	
// echo "SELECT count(1) jml FROM web_user where wa_user = '$username' and password = '$userpass' " ;
?>
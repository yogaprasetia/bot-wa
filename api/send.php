<?php
// SAMPLE : 
// http://localhost/wgweb/api/send.php?token=51&no=085692961782&text=tes&file=http://tpberp.com/home_files/proses.png
// http://localhost/wgweb/api/send.php?token=51&no=085692961782&text=text-only

include "../konfig.php";
if ($multi == 'yes') {	if (!isset($_SESSION['profil'])){ header("Location:../login") ; } }   

$hasil = mysqli_query($koneksi, "select count(1) cc FROM tmp WHERE tmp_cd = 'appname'") ;
while ($db = mysqli_fetch_array($hasil)) { $cc = $db['cc'] ;}

if ($cc==0) {mysqli_query($koneksi, "INSERT INTO tmp (tmp_cd, tmp_val) VALUES ('appname', 'wg')") ;}

mysqli_query($koneksi, "update tmp set tmp_val = 'wg' where tmp_cd = 'appname' and tmp_val = '-' ") ;
$now = date('Y-m-d H:i:s') ;
if ($multi != 'yes') {
		$hasil = mysqli_query($koneksi, "
		SELECT 
		(SELECT count(1) FROM outbox WHERE wa_mode <> '3' and wa_time <= '$now' ) outbox,
		(SELECT count(1) FROM outbox WHERE wa_mode <> '3' and wa_time > '$now' ) scheduled,
		(SELECT count(1) FROM outbox WHERE wa_mode = '3' ) sms,
		(SELECT count(1) FROM inbox) inbox,
		(SELECT count(1) FROM sent WHERE status IS null) sent,
		(SELECT count(1) FROM sent WHERE NOT status IS null) fail,
		(SELECT count(1) FROM autorespon) autorespon,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = '$status00' ) status,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = 'wagent' ) wagent,
		(SELECT count(1) FROM web_user) user, 
		(SELECT qr from web_user where id = '$profil') qr,
		(SELECT status from web_user where id = '$profil') full,
		(SELECT concat( wa_user, ' | ' , wa_no) from web_user where id = '$profil') uid,
		tmp_val app_name 
		FROM tmp 
		WHERE tmp_cd = 'appname'
		" );  
} else {
		$hasil = mysqli_query($koneksi, "
		SELECT 
		(SELECT count(1) FROM multi WHERE tipe = 'O' AND profil = '$profil' AND  wa_mode <> '3' and wa_time <= '$now' ) outbox,
		(SELECT count(1) FROM multi WHERE tipe = 'O' AND profil = '$profil' AND  wa_mode <> '3' and wa_time > '$now' ) scheduled,
		(SELECT count(1) FROM multi WHERE tipe = 'O' AND profil = '$profil' AND  wa_mode = '3') sms,
		(SELECT count(1) FROM multi WHERE tipe = 'I' AND profil = '$profil') inbox,
		(SELECT count(1) FROM multi WHERE tipe = 'S' AND profil = '$profil' AND  wa_mode = '0' AND status IS null) sent,
		(SELECT count(1) FROM multi WHERE tipe = 'S' AND profil = '$profil' AND NOT status IS null) fail,
		(SELECT count(1) FROM autorespon) autorespon,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = '$status00' ) status,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = 'wagent' ) wagent,
		(SELECT count(1) FROM web_user) user, 
		(SELECT qr from web_user where id = '$profil') qr,
		(SELECT status from web_user where id = '$profil') full,
		(SELECT concat( wa_user, ' | ' , wa_no) from web_user where id = '$profil') uid,
		tmp_val app_name 
		FROM tmp 
		WHERE tmp_cd = 'appname'
		" );  	
}
while ($db = mysqli_fetch_array($hasil))
{
$outbox 	= $db['outbox'] ;	
$scheduled 	= $db['scheduled'] ;
$sms 		= $db['sms'] ;	
$inbox 		= $db['inbox'] ;
$sent 		= $db['sent'] ;
$fail 		= $db['fail'] ;
$status		= $db['status'] ;
$autorespon	= $db['autorespon'] ;
$app_name	= $db['app_name'] ;
$user		= $db['user'] ;
$qr			= $db['qr'] ;
$uid		= $db['uid'] ;
$full		= $db['full'] ;
}
if ($sent > $user_trial_limit) { $trialend = 'Y' ; }
if ($full == 'Y' ) {$trial = 'N' ; $trialend = 'N' ;}
//---- PARAMETER
@$token 	= $_GET['token'] ;
@$wa_nos	= $_GET['no'];
@$wa_text 	= $_GET['text'] ;
@$url 		= $_GET['file'] ;
@$wa_num 	= explode(",",$wa_nos);

foreach ($wa_num as $wa_no) {
 
if (@$wa_no . @$wa_text == '') { exit ; } 

//---- VALIDASI TOKEN
$id = '' ;
$now = date('Y-m-d') ;
$hasil = mysqli_query($koneksi, "SELECT * FROM web_user WHERE concat(id,password) = '$token'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $id = $db['id'] ; $expiry = $db['expiry'] ; } 
if ( $id == '' ) { echo 'Invalid Token' ;  exit ;  }
if ( $expiry <= $now ) { echo 'Your Subscription has expired' ;  exit ;  }
if ( $trialend == 'Y' ) { echo 'Your Trial Period Has ended' ;  exit ;  }
//---- PREPARE FILE FROM URL
$wa_file = '' ; 
$nama  = '' ;
$wa_file0 = '' ;

if ($url != '') {
	$nama 		= basename($url);
	$data 		= file_get_contents($url); 
	$new 		= "../uploaded/$nama";
	$wa_file0	= $path_upload . $nama ;	
	file_put_contents($new, $data);
}

//---- INSERT OUTBOX QUEU
if ( strtolower (substr($nama, -3)) == 'jpg' OR strtolower (substr($nama, -3)) == 'epg' OR strtolower (substr($nama, -3)) == 'png' )
{ $wa_media = $wa_file0 ;  $wa_file = '' ; }
else
{ $wa_media = '' ;    $wa_file  = $wa_file0 ; }

if ($multi != 'yes') {	
	mysqli_query($koneksi,"INSERT into outbox (wa_mode, wa_no, wa_text, wa_media, wa_file) values('0','$wa_no','$wa_text','$wa_media', '$wa_file')");
} else {
	mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file) values('O', '$id', '0','$wa_no','$wa_text','$wa_media', '$wa_file')");
}
} 	
echo "ok" ;
?>
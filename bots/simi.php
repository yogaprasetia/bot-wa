<?php
/** 
Disclaimer : This SIMI API is not made by me.. I just use it in my Bot
Credit to who make this API :  https://script.google.com/macros/s/AKfycbxHHnVowe7_DJxB3w0ojsxrr0DaBdhve2S5-cFUeUeQKFyLdnbv/exec?thanx
*/

include "../konfig.php";
@$wa_no = $_GET['wa_no'];
@$wa_text0 = urlencode( $_GET['wa_text']) ;
@$wa_text = strtoupper($_GET['wa_text']);
@$wa_profil = $_GET['profil'] ;
if ($wa_no . $wa_text == '') { exit ; }   
 
$content = file_get_contents("https://script.google.com/macros/s/AKfycbxHHnVowe7_DJxB3w0ojsxrr0DaBdhve2S5-cFUeUeQKFyLdnbv/exec?text=$wa_text0");  
$content = removeslashes($content) ;
 $pecah = explode( "responsex22:x22" ,$content) ;
@$pecah2 = explode( 'x22x7dx22',$pecah[1] ) ;
$msg =  $pecah2[0] ; 
	sendMessage($wa_profil, $wa_no, $msg);
 
 
function removeslashes($string)
{
    $string=implode("",explode("\\",$string));
    return stripslashes(trim($string));
}

function sendMessage($wa_profil, $wa_no, $wa_text) {
	include "../konfig.php";
	echo $wa_text ;  //bwt TEST DI BROWSER
	$wa_media = '' ; $wa_file = '' ;
	if ($multi != 'yes') {	
		mysqli_query($koneksi,"INSERT into outbox (wa_mode, wa_no, wa_text, wa_media, wa_file) values('0','$wa_no','$wa_text','$wa_media', '$wa_file')");
	} else {
		mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file) values('O', '$wa_profil', '0','$wa_no','$wa_text','$wa_media', '$wa_file')");
	} 
}
 
?>
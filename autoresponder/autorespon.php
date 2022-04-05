<?php
/** 
This is an example of Bot. Please modify according to your needs..
The concept is simple, just trap variable wa_no and wa_text
Do Your Query, then insert the result to Outbox/Multi table
*/
 
include "../konfig.php";
@$wa_no = $_GET['wa_no'];
@$wa_text0 = $_GET['wa_text'] ;
@$wa_text = strtoupper($_GET['wa_text']);
@$wa_profil = $_GET['profil'] ; 
if ($wa_no . $wa_text == '') { exit ; } 
$answer = '' ;
 

// cari pake Logic "LIKE"
$hasil = mysqli_query($koneksi, "select answer from autorespon where profil = '$wa_profil' and logic = '%' and UPPER(keyword) like '%$wa_text%'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $answer = $db['answer'] ; }

// jika pake LIKE ga ada datanya pake Logic "="
if ( $answer == '' ) {
$hasil = mysqli_query($koneksi, "select answer from autorespon where profil = '$wa_profil' and  logic <> '%' and UPPER(keyword) = '$wa_text'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $answer = $db['answer'] ; }	
}

// keluar jika ga ada di data autorespon
if ( $answer == '' ) { exit ;  }
sendMessage($wa_profil, $wa_no, $answer);
 
	

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
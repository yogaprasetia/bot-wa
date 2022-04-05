<?php 
/** 
SAMPLE SMS BOT
*/

include "../konfig.php";

//---- PARAMETER
@$wa_no = $_GET['wa_no'];
@$wa_text = strtoupper($_GET['wa_text']);
@$token 	= $_GET['token'] ; 
if ($wa_no . $wa_text == '') { exit ; } 


//---- VALIDASI TOKEN
$id = '' ;
$hasil = mysqli_query($koneksi, "SELECT id FROM web_user WHERE concat(id,password) = '$token'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $id = $db['id'] ; }
if ( $id == '' ) { echo 'Invalid Token !' ;  exit ;  }
  
$wa_profil = $id ;
  

 
switch($wa_text) {
	
case 'INFO':
$msg = "-Halo.. I am DEMO BOT-  
Please type sample keyword for testing Bot :
-----------------------------------

*ID*
*SHOLAT*
*I LOVE U*
*DAY* 01-12-2020  or other date
 
*QURAN*
_it will give you random Quote from Holy Quran ,_
";
sendMessage($wa_profil, $wa_no, $msg);
break;

	
case 'ID':
sendMessage($wa_profil, $wa_no, "Your ID = $wa_no");
break;
 
case 'I LOVE U':
$msg = "Uuu... thanx.. I Love U too.. " ;
sendMessage($wa_profil, $wa_no, $msg );
break;
 
case 'SHOLAT':
  $kode = 36 ;
    $content = file_get_contents("http://jadwalsholat.pkpu.or.id/monthly.php?id=". $kode);
    $pecah = explode( '<tr class="table_highlight" align="center">' ,$content) ;
    $pecah2 = explode( '</tr>' ,$pecah[1] ) ;
    
    $fix = $pecah2[0] ;
    $fix =  str_replace('</td>' , '', $fix ) ; 
    $fix =  str_replace('</b>' , '', $fix ) ; 
    $pecah3 = explode( '<td>' , $fix ) ;
    
    //--------------------------------------------------
    @$pecah4 = explode( '<td colspan="7" align="center">' ,$content) ;
    @$pecah5 = explode( '</small>' , $pecah4[1]) ;
    @$fix2 = $pecah5[0];
    $fix2 =  str_replace('<b>' , '', $fix2 ) ; 
    $fix2 =  str_replace('</b>' , '', $fix2 ) ; 
    $fix2 =  str_replace('<br>' , '', $fix2 ) ;  
    $fix2 =  str_replace('<small>' , '', $fix2 ) ;  
     
    //-------------------------------------------------- 
$hasil = "*JADWAL SHOLAT JAKARTA* 
Tanggal $pecah3[1] ". trim($fix2) . "
- Subuh : $pecah3[2]
- Dzuhur : $pecah3[3]
- Ashar : $pecah3[4]
- Maghrib : $pecah3[5]
- Isya : $pecah3[6]
" ;
    
    $hasil =  str_replace('<b>' , '', $hasil ) ;    
    $hasil =  str_replace('(' , '<br>(', $hasil ) ;    
    $msg = $hasil ;
    $msg = str_replace('<br>', '%0A', $msg );
	sendMessage($wa_profil, $wa_no, $msg);
    break; 
	

case 'QURAN':
  $content = file_get_contents("http://ayatalquran.com/random");  
   $pecah = explode( '<h2 id="aya_text">' ,$content) ;
   $pecah2 = explode( '</h2>' ,$pecah[1] ) ;
   $quran =  $pecah2[0] ;
   
   $pecah = explode( '<span id="sura_id">' ,$content) ;
   $pecah2 = explode( '</span>' ,$pecah[1] ) ;
   $surat =  $pecah2[0] ;

   $pecah = explode( '<span id="verse_id">' ,$content) ;
   $pecah2 = explode( '</span>' ,$pecah[1] ) ;
   $ayat =  $pecah2[0] ;	
   
   $msg =  '"' . $quran . '"( Holy Quran - '. "$surat:$ayat )" ;
 
   sendMessage($wa_profil, $wa_no, $msg );
   break;
	
}
 

//---  Using IF
if (substr($wa_text,0,4) == 'DAY ') { 
	$pecah = explode(' ', $wa_text) ;
	$date = $pecah[1] ; 
	$nameOfDay = date('l', strtotime($date));
	$msg =  $date . '  is  '. $nameOfDay  ;
	sendMessage($wa_profil, $wa_no, $msg);
}		
	

function sendMessage($wa_profil, $wa_no, $wa_text) {
	include "../konfig.php";
	echo $wa_text ;  //bwt TEST DI BROWSER
	$wa_media = '' ; $wa_file = '' ;
	if ($multi != 'yes') {	
		mysqli_query($koneksi,"INSERT into outbox (wa_mode, wa_no, wa_text, wa_media, wa_file) values('3','$wa_no','$wa_text','$wa_media', '$wa_file')");
	} else {
		mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file) values('O', '$wa_profil', '3','$wa_no','$wa_text','$wa_media', '$wa_file')");
	} 
}
 
?>
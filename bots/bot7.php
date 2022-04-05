<?php
/* 
This is an example of Bot. Please modify according to your needs..
The concept is simple, just trap variable wa_no and wa_text
Do Your Query, then insert the result to Outbox/Multi table

For demo please text "INFO" to your WhatsApp Number
*/

include "../konfig.php";
@$wa_no = $_GET['wa_no'];
@$wa_text0 = $_GET['wa_text'] ;
@$wa_text = strtoupper($_GET['wa_text']);
@$wa_profil = $_GET['profil'] ;
if ($wa_no . $wa_text == '') { exit ; } 

$wa_text = strtoupper($wa_text);

switch($wa_text) {
	
case 'HI':
	$msg = "Hello... I am your personal assistant.
	I can help you with queries regarding the following.

	1 18K Gold Rate
	2 22K Gold Rate
	3 23.5K Gold Rate
	4 24K Gold Rate
	5 Silver Rate
	6 Order Status
	7 Cotact Us
	8 Other Queries
	9 Feedback

	Please select an option to move ahead.
	Example: Reply *1* to get 22K Gold Rate.
	";
	sendMessage($wa_profil, $wa_no, $msg);
	break;

	;
 
   
case '1':
  $json = file_get_contents("https://siddhi.parasinfotech.co.in/siddhi50_api/api/master/rate/siddhidsj/G/18");  
  $msg =  ' 18K Gold Rate Per Gram Rs.'. substr($json,10,7);

  sendMessage($wa_profil, $wa_no, $msg );
  break;

case '2':
  $json = file_get_contents("https://siddhi.parasinfotech.co.in/siddhi50_api/api/master/rate/siddhidsj/G/22");  
  $msg =  ' 22K Gold Rate Per Gram Rs.'. substr($json,10,7);

  sendMessage($wa_profil, $wa_no, $msg );
  break;

case '3':
  $json = file_get_contents("https://siddhi.parasinfotech.co.in/siddhi50_api/api/master/rate/siddhidsj/G/23.5");  
  $msg =  ' 23.5K Gold Rate Per Gram Rs.'. substr($json,10,7);

  sendMessage($wa_profil, $wa_no, $msg );
  break;
  
case '4':
  $json = file_get_contents("https://siddhi.parasinfotech.co.in/siddhi50_api/api/master/rate/siddhidsj/G/24");  
  $msg =  ' 24K Gold Rate Per Gram Rs.'. substr($json,10,7);

   sendMessage($wa_profil, $wa_no, $msg );
   break;

case '5':
  $json = file_get_contents("https://siddhi.parasinfotech.co.in/siddhi50_api/api/master/rate/siddhidsj/S/0");  
  $msg =  ' Silver Rate Per KG Rs.'. substr($json,10,2)  * 1000;

   sendMessage($wa_profil, $wa_no, $msg );
   break;

case '6':
  $msg =  ' Order Status Under Developmet, Coming Soon....';

   sendMessage($wa_profil, $wa_no, $msg );
   break;
   
case '7':
  $msg =  ' Contact Us Under Developmet, Coming Soon....';

   sendMessage($wa_profil, $wa_no, $msg );
   break;

case '8':
  $msg =  ' Other Queries Under Developmet, Coming Soon....';

   sendMessage($wa_profil, $wa_no, $msg );
   break;

case '9':
  $msg =  ' Feedback Under Developmet, Coming Soon....';

   sendMessage($wa_profil, $wa_no, $msg );
   break;

case '10':
  $msg =  ' Under Developmet, Coming Soon....';

   sendMessage($wa_profil, $wa_no, $msg );
   break;

case '11':
  $msg =  ' Under Developmet, Coming Soon....';

   sendMessage($wa_profil, $wa_no, $msg );
   break;
   
   
}
 
 
function sendMessage($wa_profil, $wa_no, $wa_text) {
	include "../konfig.php";
	echo $wa_text ;  //bwt TEST DI BROWSER
	$wa_media = '' ; $wa_file = '' ;
	/*mysqli_query($koneksi,"INSERT into outbox (wa_mode, wa_no, wa_text, wa_media, wa_file) values('0','$wa_no','$wa_text','$wa_media', '$wa_file')");*/
	mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file) values('O', '$wa_profil', '0','$wa_no','$wa_text','$wa_media', '$wa_file')");
	/*if ($multi != 'yes') {	
		mysqli_query($koneksi,"INSERT into outbox (wa_mode, wa_no, wa_text, wa_media, wa_file) values('0','$wa_no','$wa_text','$wa_media', '$wa_file')");
	} else {
		mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file) values('O', '$wa_profil', '0','$wa_no','$wa_text','$wa_media', '$wa_file')");
	}*/ 
}
?>
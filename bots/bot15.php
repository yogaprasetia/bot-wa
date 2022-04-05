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
	
case 'HELLO':
	$msg = "Hello... I am your personal assistant.
	I can help you with queries regarding the following.

	1 22K Gold Rate
	2 23K Gold Rate
	3 24K Gold Rate
	4 Silver Rate
	5 Order Status
	6 Cotact Us
	7 Other Queries
	8 Feedback

	Please select an option to move ahead.
	Example: Reply *1* to get 22K Gold Rate.
	
	";
	sendMessage($wa_profil, $wa_no, $msg);
	break;

	;
 
   
case '1':
  $json = file_get_contents("https://siddhi.parasinfotech.co.in/siddhi50_api/api/master/rate/sdemo2/G/22");  
  $msg =  ' 22K Gold Rate Rs.'. substr($json,10,7) * 10;

  sendMessage($wa_profil, $wa_no, $msg );
  break;

case '2':
  $json = file_get_contents("https://siddhi.parasinfotech.co.in/siddhi50_api/api/master/rate/sdemo2/G/23");  
  $msg =  ' 23K Gold Rate Rs.'. substr($json,10,7) * 10;

  sendMessage($wa_profil, $wa_no, $msg );
  break;
  
case '3':
  $json = file_get_contents("https://siddhi.parasinfotech.co.in/siddhi50_api/api/master/rate/sdemo2/G/24");  
  $msg =  ' 24K Gold Rate Rs.'. substr($json,10,7) * 10;

   sendMessage($wa_profil, $wa_no, $msg );
   break;

case '4':
  $json = file_get_contents("https://siddhi.parasinfotech.co.in/siddhi50_api/api/master/rate/sdemo2/S/0");  
  $msg =  ' Silver Rate Per KG Rs.'. substr($json,10,2)  * 1000;

   sendMessage($wa_profil, $wa_no, $msg );
   break;

case '5':
  $msg =  ' Order Status Under Developmet, Coming Soon....';

   sendMessage($wa_profil, $wa_no, $msg );
   break;
   
case '6':
  $msg =  '
Paras Infotech
Office no.1, First Floor,
Shiv Darshan, Opp. Shivaji Statue
Gultekdi, Market Yard,
Pune - 411037

Tel : 			020-24261975
Office Mobile :	+917498242199

Kiran Patel :	+919822307929
Sanjay :		+919284204949
				+919850327222
Kiran Vee :		+919595235306
Jafar :			+919921735607

website : 		www.parasinfotech.co.in
email: 			info@parasinfotech.co.in
				parasinfotech39@gmail.com
';

   sendMessage($wa_profil, $wa_no, $msg );
   break;

case '7':
  $msg =  ' Other Queries Under Developmet, Coming Soon....';

   sendMessage($wa_profil, $wa_no, $msg );
   break;

case '8':
  $msg =  ' Feedback Under Developmet, Coming Soon....';

   sendMessage($wa_profil, $wa_no, $msg );
   break;

case '9':
  $msg =  ' Under Developmet, Coming Soon....';

   sendMessage($wa_profil, $wa_no, $msg );
   break;

case '10':
  $msg =  ' Under Developmet, Coming Soon....';

   sendMessage($wa_profil, $wa_no, $msg );
   break;
   
   
}
 
 
function sendMessage($wa_profil, $wa_no, $wa_text) {
	include "../konfig.php";
	echo $wa_text ;  //bwt TEST DI BROWSER
	$wa_media = '' ; 
	$wa_file = '' ;
	mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file) values('O', '$wa_profil', '0','$wa_no','$wa_text','$wa_media', '$wa_file')");
	/*if ($multi != 'yes') {	
		mysqli_query($koneksi,"INSERT into outbox (wa_mode, wa_no, wa_text, wa_media, wa_file) values('0','$wa_no','$wa_text','$wa_media', '$wa_file')");
	} else {
		mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file) values('O', '$wa_profil', '0','$wa_no','$wa_text','$wa_media', '$wa_file')");
	}*/ 
}
?>
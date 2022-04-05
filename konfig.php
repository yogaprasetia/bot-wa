<?php  
date_default_timezone_set("Asia/Jakarta");   	// Cange if u are not in here.. 
//date_default_timezone_set("Asia/Calcutta");   // if u are in India

@session_start();  
@$profil = $_SESSION['profil'] ;	 

$admin_password	= 'admin' ;	// You must change this !!
$admin_wa		= '6285692961782' ;	// It's my number.. change to yours

$path_upload 	= 'C:/wa-gw/xampp/htdocs/uploaded/' ;   // Don't change.. except u install on ur own XAMPP

// if use multi, set yes
$multi			= 'yes' ;	// if this only use by you ONLY.. set no.. is better
$maxuser		= 25 ;  	// change by ur self.. maximum 999,999 , but remember of ur RAM and CPU :-D

// database connection
$host 			= 'localhost' ; 
$user 			= "root";  
$password 		= ""; 
$database 		= "wagw";  
 
$koneksi = mysqli_connect($host, $user, $password, $database );
if (!$koneksi) { die("Connection Error : " . mysqli_connect_error());} 
$koneksi->set_charset("UTF8");   
 
$profil00 = str_pad($profil, 6, '0', STR_PAD_LEFT);
$status00 = 'status' . $profil00 ; 
if ($multi != 'yes') {$profil00 = '' ; $status00 = 'status' ; }

// ------------------------- EDIT THIS --------------------------------------------------------
$appname = 'WA-GW' ;  		// Change ur own name.. WA-GW / Whatsapp Sender, or any else.. up to u
$hide_footer = 'Y' ;	
$no_wagent = 'Y' ;   		// If your Windows allow to PHP Execute EXE, set to Y (Recomended)
$user_trial_limit = 100  ;	// After limit, user can not send.. and show text BUY FULL VERSION, login as ADMIN to set FULL VERSION
$hide_sms = 'N' ; 			// Up to you hide or not 
$logo_left = 'wagw.png'   ;	// put files in folder C:\wa-gw\xampp\htdocs\wg_files
$logo_text =  'wagw3.png' ;

?>
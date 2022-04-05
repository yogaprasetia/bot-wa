<?php 
include "../konfig.php";

if ($multi != 'yes') {
	 $sql = "SELECT * FROM inbox 
	 where wa_time between 'as_awal' and 'as_akhir 23:59' 
	 and concat(wa_no, wa_text) like '%as_cari%' order by id desc " ;    
} else {
	 $sql = "SELECT * FROM multi 
	 WHERE tipe = 'I' AND profil = '$profil' 
	 and  wa_time between 'as_awal' and 'as_akhir 23:59' 
	 and concat(wa_no, wa_text) like '%as_cari%' order by id desc " ; 	 
} 

?>
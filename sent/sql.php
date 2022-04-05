<?php 
include "../konfig.php";

if ($multi != 'yes') {
	 $sql = "SELECT * FROM sent 
	 where wa_time between 'as_awal' and 'as_akhir 23:59'   and status is null
	 and concat(wa_no, wa_text) like '%as_cari%' order by id desc " ;    
} else {
	 $sql = "SELECT * FROM multi 
	 WHERE tipe = 'S' AND profil = '$profil' and status is null
	 and  wa_time between 'as_awal' and 'as_akhir 23:59'  
	 and concat(wa_no, wa_text) like '%as_cari%' order by id desc " ; 	 
} 

?>
<?php 
//---- PARAMETER
@$profil 	= $_GET['profil'] ; 
if (@$profil=='') {exit ;}


echo file_exists ( "../bots/smsbot$profil.php" ) ;
?>
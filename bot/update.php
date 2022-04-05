<?
include "../konfig.php";
$bot 	= $_POST["bot"]  ; 
$urlbot	= $_POST["urlbot"]  ;

switch($bot) {

case '0':
	$urlbot = '' ;
	break ;

case '1':
	$urlbot = 'http://localhost/bots/autorespon.php';
	break ;

case '2':
	$urlbot = 'http://localhost/bots/simi.php';
	break ;

case '3':
	$urlbot = 'http://localhost/bots/bot.php';
	break ;

case '4':
	$urlbot = "http://localhost/bots/bot$profil.php";
	break ;
}
 
mysqli_query($koneksi,"update web_user set bot_mode = '$bot', bot_url = '$urlbot' where id = '$profil' ");
header("Location:index.php?ok=yes");	 
?>
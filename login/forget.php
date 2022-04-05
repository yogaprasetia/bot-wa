<? 
include "../konfig.php"; 
 
@$email = $_GET['email'] ; 
$msg  = "Your Login Access to WGWEB :\r\n\r\r"  ;
$query = mysqli_query($koneksi,"SELECT concat('\nwa no\t: ', wa_no, '\nuser\t: ', wa_user, '\npass\t: ', password, '\n') login FROM web_user WHERE email = '$email' ") ;
while ($rs = mysqli_fetch_array($query))
{$msg 	= $msg . $rs['login'] . "\r-------------------------------\r"; }	

if ($msg  == "Your Login Access to WGWEB :\r\n\r\r"  ) { echo 'INVALID.. EMAIL NOT REGISTERED !! ' ;} else { 
//mail ($email, 'RETRIEVE PASSWORD TO LOGIN WGWEB', $msg ) ;
echo "Okay.. Password has been sent also to your Email\nPlease Check and Login" ; 
$msg = str_replace("\r", "",$msg) ;
$msg = str_replace("\n", "<br>",$msg) ; 
 
$msg = urlencode($msg) ;
$app = urlencode($appname) ;
//http://wa-gw.com/mailer/wgweb2.php?email=hermawan.dony@framas.com&msg=halooo&app=WA%20SENDER
file_get_contents("http://wa-gw.com/mailer/wgweb2.php?email=$email&msg=$msg&app=$app") ; 
} 
?>
 
      
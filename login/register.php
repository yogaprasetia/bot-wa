<? 
include "../konfig.php";
 
@$email = $_GET['email'] ;
@$user = $_GET['user'] ;
@$wa = $_GET['wa'] ;
$key = substr($wa, 3, 2) . substr($wa,-2) ;
$wa = str_replace('+', '', $wa) ;
$wa = str_replace(' ', '', $wa) ;
$wa = str_replace('-', '', $wa) ;
if ( $wa * 1 == 0 )  {echo "INVALID WhatsApp Number !"; exit ; }

if ($multi != 'yes') {echo "Sorry.. MULTI USER NOT ALLOWED IN THIS SERVER.. "; exit ; }

//Jika sudah MAXIMAL tidak bisa Register
$max = $maxuser ;
$query = mysqli_query($koneksi,"SELECT count(1) jml FROM web_user") ;
while ($rs = mysqli_fetch_array($query))
{$jml 	= $rs['jml'] ; }	
if ($jml >= $max ) {echo "Sorry.. SERVER ARE FULL..\nCannot Register anymore. \nWhatsApp $admin_wa to get $appname Web Account"; exit ; }


	
//Jika USER sudah ADA tidak bisa Register
$query = mysqli_query($koneksi,"SELECT count(1) jml FROM web_user where wa_user='$user' ") ;
while ($rs = mysqli_fetch_array($query))
{$jml 	= $rs['jml'] ; }	
if ($jml > 0) {echo "User Name $user already taken !"; exit ; }


//Jika WA NO sudah ADA tidak bisa Register
$query = mysqli_query($koneksi,"SELECT count(1) jml FROM web_user where wa_no='$wa' ") ;
while ($rs = mysqli_fetch_array($query))
{$jml 	= $rs['jml'] ; }	
if ($jml > 0) {echo "Whatsapp Number $wa  already registered !"; exit ; }



if (!@$key) { exit ; $pass = '' ; } else {
$password =  substr(intval((((( $key + 9831) * 21) + 55) / 521) + 189 / 2), -5) ;
$expiry = date('Y-m-d', strtotime(' + 1 days'));

mysqli_query($koneksi,"INSERT INTO web_user (wa_user, wa_no, email, password, expiry) VALUES ( '$user', '$wa', '$email', '$password' , '$expiry' ) ;"); 
}
 
echo "Okay.. $user\nYour Password = $password\n\nThis information has been sent also to your Email\nPlease Check and Login" ;
 
$app = urlencode($appname) ;

// READ  THIS !
// It's use my own Hosting & Domain, if You need to make your self  :
// Upload files in C:\wa-gw\xampp\htdocs\login\UPLOAD TO YOUR HOSTING to your hosting, and setting Your own gmail account (see README)
file_get_contents("http://wa-gw.com/mailer/wgweb.php?email=$email&nama=$user&pass=$password&app=$app") ; 
?>
  
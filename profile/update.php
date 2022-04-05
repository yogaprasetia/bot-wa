<?
include "../konfig.php";
$wa_no = $_POST["wa_no"]  ;
$password = $_POST["password"]  ; 
$disableread = $_POST["disableread"]  ;
  

if ($wa_no * 1 == 0) {
	echo '<script>alert("INVALID Phone Number !") ; </script>' ;	
	header("Location:index.php?ok=no"); 
} 
else 
{
	mysqli_query($koneksi,"update web_user set wa_no = '$wa_no', password = '$password', disable_read = '$disableread'  where id = '$profil' ");
 
	echo '<script>alert("Profile Updated..") ; </script>' ;	
	header("Location:index.php?ok=yes");
}
?>
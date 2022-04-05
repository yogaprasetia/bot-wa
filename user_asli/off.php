<?
include "../konfig.php";
@$id =  $_GET["id"] ;
@$id00 =  $_GET["id00"] ;

mysqli_query($koneksi, "insert into tmp (tmp_cd) VALUES ('off$id00') ") ;
mysqli_query($koneksi, "update web_user set qr = '' where id='$id'") ;
mysqli_query($koneksi, "delete from tmp where tmp_cd = 'status$id00'") ; 

 
header("Location:index.php");
 

?>
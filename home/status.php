<?php 
include '../konfig.php' ; 
$hasil = mysqli_query($koneksi, "SELECT tmp_val status FROM tmp WHERE tmp_cd = '$status00' " );   
$status = '' ;
while ($db = mysqli_fetch_array($hasil))
{ $status		= $db['status'] ; }
if ($status == 'Ready') { echo '<button type="button" class="btn btn-primary">Ready</button>' ;}
else  { echo '<button type="button" class="btn btn-danger">Not Connect</button>' ;}
?>
 
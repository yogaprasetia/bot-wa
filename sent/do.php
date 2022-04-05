<script>
function openWin() {
    myWindow = window.open("", "popup", "width=500,height=600");  
    myWindow.focus(); 
    return false;
}	
</script>
 
<?  
ini_set('max_execution_time', 600); 
include "../konfig.php";
include "sql.php";

$format 	= $_GET["format"] ;
$awal 	= $_GET["awal"] ;
$akhir 	= $_GET["akhir"] ; 
$cari 	= $_GET["cari"] ;
 
$sql = str_replace ('as_awal', $awal, $sql) ;
$sql = str_replace ('as_akhir', $akhir, $sql) ;
$sql = str_replace ('as_cari', $cari, $sql) ;
 
if ($cari !='') { $html = "<b>FILTER : $cari</b><br>" ; } else { $html = '' ; }
$hasil = mysqli_query($koneksi, $sql ); 

if ($format == 'scr') { $tabel = "<table class='table table-hover table-condensed table-striped table-bordered'>" ; } 
if ($format == 'xls') { $tabel = "<table cellpadding='4' style='border-collapse:collapse;  font-size: 8pt' border='1' >" ; }

 
$html = $tabel . "
    <thead>  
  	   <tr>
	    <th>No.</th>
		<th align='center'><center>Time</center></th>
		<th align='center'><center>Number</center></th>
		<th align='center'><center>Text</center></th>		
		<th align='center'><center>Media</center></th>	
		<th align='center'><center>File</center></th>	
		<th align='center'><center>Resend</center></th>		
    </thead>
    <tbody>
";
  
$no = 0 ;
while ($db = mysqli_fetch_array($hasil))
{	$id 		= $db['id'] ;	
	$wa_time 	= $db['wa_time'] ;		
    $wa_no 		= $db['wa_no'] ;
	$wa_text	= $db['wa_text'] ; 
    $wa_media	= $db['wa_media'] ; 
	$wa_file	= $db['wa_file'] ;  
	$wa_text = str_replace("\n", '<br>', $wa_text ) ;
	$no++ ; 

$html = $html . " 
      <tr>
			<td width=30 align='center'  > $no </td>
            <td width=120> $wa_time </td>
            <td width=120> $wa_no </td>   
			<td> $wa_text </td>   
			<td> $wa_media </td>  
			<td> $wa_file </td>  			
<td  width=20 class='text-center'>                                                
<a href='../send/index3.php?id=$id' target='popup' onclick='openWin()' style='text-decoration: none;color:#333;'><button><i class='fa fa-send'></i></button></a> 
</td> 			
      </tr>
";		  
 
} 
$html = $html . " 	 
	</tbody>
  </table>" ;

  
if ($format == 'scr') { echo $html ; } 

if ($format=='xls') {
	$nama_file = "Sent". '_' . $awal . '_' . $akhir . ".xls";   
	header("Pragma: public");   
	header("Expires: 0");   
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");     
	header("Content-Type: application/force-download");     
	header("Content-Type: application/octet-stream");   
	header("Content-Type: application/download");   
	header("Content-Disposition: attachment;filename=".$nama_file."");  
	header("Content-Transfer-Encoding: binary ");
	echo  $html ;
}	
?>
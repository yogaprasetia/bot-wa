<script>  
 
 function reload()    
 {  
     mode = 'N' ;
     if ($("#refresh").is(':checked')) { mode = 'Y' ; }  
 $.ajax({
	url: "reload.php" ,  		
	success: function(data){  

	}         
	});       
 }        

 function off()    
 { 
     mode = 'N' ;
     if ($("#refresh").is(':checked')) { mode = 'Y' ; }  
 $.ajax({
	url: "off.php" ,  		
	success: function(data){  
	alert('WhatsApp Disconected..') ;
	}         
	});       
 }
 
</script> 

<?php include '../konfig.php' ; 
 	 include "../qrcode/qrlib.php"; 
	 $tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
	 if (!file_exists($tempdir)) //Buat folder bername temp
		mkdir($tempdir);

$ms = round(microtime(true) * 100);  // --- SOLVE CACHING IMAGE	
	
$now = date('Y-m-d H:i:s') ;
if ($multi != 'yes') {
		$hasil = mysqli_query($koneksi, "
		SELECT 
		(SELECT count(1) FROM outbox WHERE wa_mode <> '3' and wa_time <= '$now' ) outbox,
		(SELECT count(1) FROM outbox WHERE wa_mode <> '3' and wa_time > '$now' ) scheduled,
		(SELECT count(1) FROM outbox WHERE wa_mode = '3' ) sms,
		(SELECT count(1) FROM inbox) inbox,
		(SELECT count(1) FROM sent WHERE status IS null) sent,
		(SELECT count(1) FROM sent WHERE NOT status IS null) fail,
		(SELECT count(1) FROM autorespon) autorespon,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = '$status00' ) status,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = 'wagent' ) wagent,
		(SELECT TIMESTAMPDIFF(MINUTE, tmp_val , now()) FROM tmp WHERE tmp_cd = 'wagent' ) dif,
		(SELECT count(1) FROM web_user) user, 
		(SELECT qr from web_user where id = '$profil') qr,	
		tmp_val app_name 
		FROM tmp 
		WHERE tmp_cd = 'appname'
		" );  
} else {
		$hasil = mysqli_query($koneksi, "
		SELECT 
		(SELECT count(1) FROM multi WHERE tipe = 'O' AND profil = '$profil' AND  wa_mode <> '3' and wa_time <= '$now' ) outbox,
		(SELECT count(1) FROM multi WHERE tipe = 'O' AND profil = '$profil' AND  wa_mode <> '3' and wa_time > '$now' ) scheduled,
		(SELECT count(1) FROM multi WHERE tipe = 'O' AND profil = '$profil' AND  wa_mode = '3') sms,
		(SELECT count(1) FROM multi WHERE tipe = 'I' AND profil = '$profil') inbox,
		(SELECT count(1) FROM multi WHERE tipe = 'S' AND profil = '$profil' AND status IS null) sent,
		(SELECT count(1) FROM multi WHERE tipe = 'S' AND profil = '$profil' AND NOT status IS null) fail,
		(SELECT count(1) FROM autorespon) autorespon,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = '$status00' ) status,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = 'wagent' ) wagent,
		(SELECT TIMESTAMPDIFF(MINUTE, tmp_val , now()) FROM tmp WHERE tmp_cd = 'wagent' ) dif,
		(SELECT count(1) FROM web_user) user, 
		(SELECT qr from web_user where id = '$profil') qr,		
		tmp_val app_name 
		FROM tmp 
		WHERE tmp_cd = 'appname'
		" );  	
}
while ($db = mysqli_fetch_array($hasil))
{
$outbox 	= $db['outbox'] ;	
$scheduled 	= $db['scheduled'] ;
$sms 		= $db['sms'] ;	
$inbox 		= $db['inbox'] ;
$sent 		= $db['sent'] ;
$fail 		= $db['fail'] ;
$status		= $db['status'] ;
$autorespon	= $db['autorespon'] ;
$app_name	= $db['app_name'] ;
$user		= $db['user'] ;
$qr			= $db['qr'] ;
$dif		= $db['dif'] ;
}


	//isi qrcode jika di scan
	$codeContents = $qr ; 

	//simpan file kedalam folder temp dengan nama 001.png
	QRcode::png($codeContents,$tempdir."$profil.png", QR_ECLEVEL_L, 5);  
//	echo '<img src="'.$tempdir. $profil. '.png.?t='. $ms .'" />' ;
	
	
	
if ($status == '' ) { $status = 'Not Connect' ;}
$wagent = '???' ; $qr = '' ; $isfull = 'N' ;
$hasil = mysqli_query($koneksi, "SELECT qr, expiry, DATE_FORMAT(expiry, '%M %d') exp, status, DATE_ADD(expiry, INTERVAL -7 DAY) notif from web_user where id = '$profil'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $qr = $db['qr'] ; $expiry = $db['expiry'] ; $exp  = $db['exp'] ;  $isfull  = $db['status'] ; $notif  = $db['notif'] ; }

 if ($isfull == 'Y' ) {$fulltxt = 'FULL ACCESS' ;} else {$fulltxt = 'TRIAL' ;}

$hasil = mysqli_query($koneksi, "SELECT count(1) jml from tmp WHERE tmp_cd = 'status$profil00'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $c = $db['jml'] ; }
if ($c==0 AND $qr!='wait') { $qr ='' ; }

$hasil = mysqli_query($koneksi, "SELECT tmp_val wagent FROM tmp WHERE tmp_cd = 'wagent'" )  ;
while ($db = mysqli_fetch_array($hasil)) { $wagent = $db['wagent'] ; }


 
if (@$qr!='') { 
	if ($qr == 'wait' ) {
		$qrimg = "../wg_files/loaderwa2.gif" ;} 
	else 
	{ 
		$qrimg = "./temp/$profil.png?t=$ms" ; 
	}
}	
  else { $qrimg = "../offline.png" ; }

 
if ($status	== 'Ready') { $qrimg = "../online.png" ; } //else {  $qrimg = "../offline.png" ; }
 
?> 
	<a href='../outbox'>						
	<div class="col-md-3 col-sm-3 col-xs-3">
		<div class="panel panel-teal rounded shadow">
			<div class="panel-heading text-center">
				<p class="inner-all no-margin">
					<i class="fa fa-clock-o fa-2x"></i><span class="h4 text-strong"> Queue</span>  
				</p>  
			</div><!-- /.panel-heading -->
			<div class="panel-body text-center">
			<p class="h4 no-margin text-strong"><? echo number_format($outbox) ; ?></p>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div>	
	</a>

	<a href='../inbox'>						
	<div class="col-md-3 col-sm-3 col-xs-3">
		<div class="panel panel-success rounded shadow">
			<div class="panel-heading text-center">
				<p class="inner-all no-margin">
					<i class="fa fa-download fa-2x"></i><span class="h4 text-strong"> Inbox</span>  
				</p>  
			</div><!-- /.panel-heading -->
			<div class="panel-body text-center">
			<p class="h4 no-margin text-strong"><? echo number_format($inbox) ; ?></p>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div>	
	</a>

	<a href='../sent'>						
	<div class="col-md-3 col-sm-3 col-xs-3">
		<div class="panel panel-info rounded shadow">
			<div class="panel-heading text-center">
				<p class="inner-all no-margin">
					<i class="fa fa-check fa-2x"></i><span class="h4 text-strong"> Sent</span>  
				</p>  
			</div><!-- /.panel-heading -->
			<div class="panel-body text-center">
			<p class="h4 no-margin text-strong"><? echo number_format($sent) ; ?></p>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div>	
	</a>

	<a href='../fail'>						
	<div class="col-md-3 col-sm-3 col-xs-3">
		<div class="panel panel-danger rounded shadow">
			<div class="panel-heading text-center">
				<p class="inner-all no-margin">
					<i class="fa fa-times fa-2x"></i><span class="h4 text-strong"> Failed</span>  
				</p>  
			</div><!-- /.panel-heading -->
			<div class="panel-body text-center">
			<p class="h4 no-margin text-strong"><? echo number_format($fail) ; ?></p>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div>	
	</a>
 
<?
 if ($profil==0) { $expiry  = '2090-12-31' ; $fulltxt = 'SUPER ACCESS' ;}
 if ($expiry < date('Y-m-d') ) { ?> 
<center>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="jumbotron" style="font_size:20px;background-color:white;-webkit-box-shadow: 0px 0px 12px -6px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 12px -6px rgba(0,0,0,0.75);
box-shadow: 0px 0px 12px -6px rgba(0,0,0,0.75);padding-top: 10px; padding-bottom: 20px;">
        <h2>🚫 THIS ACCOUNT HAS BEEN SUSPENDED !!</h2>
  
	<p class="btn">	
	<a href='https://api.whatsapp.com/send?phone=<? echo $admin_wa ?>' target="_blank">
	<strong> Your Subscription Expired On <? echo $exp    ?></strong> <br>Please contact Admin to get Renewal..
	</a>
	</p>
	
</div>
</div> 
</center>		
<?
  } else { ?>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-white rounded shadow panel-scrollable">
			<div class="panel-heading">
			
 <?  if ($profil != '0' AND $notif < date('Y-m-d') ) {   ?><div style="color:red;"><center><marquee direction="right" behavior="alternate">
<strong> Your subscription will expire on <?echo $exp ?>, Please renew before expired !</strong></marquee> </center></div>
<? } ?> 
				<button class="btn btn-primary btn-open col-md-4 col-sm-6 col-xs-6" onclick="reload()" <i class="fa fa-refresh"> </i>  CONNECT NOW</button>  
				<button class="btn btn-danger btn-open col-md-3 col-sm-6 col-xs-6" onclick="off()" ><i class="fa fa-times"> </i> Close</button> 
				<a href='https://api.whatsapp.com/send?phone=<? echo $admin_wa ?>' target="_blank">
				<button class="btn btn-default btn-open col-md-5 col-sm-12 col-xs-12" ><i class="fa fa-comments"> </i>  Contact Admin if you have any queries </button>  
				</a>
			</div><!-- /.panel-heading -->
			
			
			<div class="panel-body text-center" style="background-color:white;">
			<?   echo  '<hr>' ; 
			 
			?>
			<!--<img name="capture" src="../capture/wa<?echo $profil00 ?>.png" class="img-rounded" alt="- Please Reload WhatsApp Web to show Image -">-->
			<img name="capture" src="<? echo $qrimg ?>" 
			<? if ($qr == '' OR $status = 'Ready') {echo 'height="90%"' ;} ?>>
			</div><!-- /.panel-body -->
			
			<hr>
			<? 
			//echo $wagent ;
			if($no_wagent!='Y') {
			if ($wagent== '???' OR $dif > 0 ) { ?>
			<div class="panel-heading text-center" style="background-color:red;">
			<h4 style="color:yellow;" >W-Agent NOT CONNECTED !! </h4><a href="wagent.php"><span style="color:white;">- Please contact Admin to connect -	</span></a>
			<? } else { ?>			
			<div class="panel-heading text-center" style="background-color:#DDD;">
			<small>WAgent Online at <? echo $wagent ?> - Time Now : <? echo $now  ?></small></div>
			<? } }   ?>		
 
			<div class="panel-heading text-center" style="background-color:#f5f5f5;">
			<small><strong>SUBSCRIBE ACTIVE UNTIL : <? echo $expiry  ?> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;STATUS : <? echo $fulltxt ?> </strong></small>
			</div>
		</div><!-- /.panel -->

	</div>
  <? } ?>
  
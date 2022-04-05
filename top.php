<?php 
include 'konfig.php' ;
if ($multi == 'yes') {	if (!isset($_SESSION['profil'])){ header("Location:../login") ; } }   

$hasil = mysqli_query($koneksi, "select count(1) cc FROM tmp WHERE tmp_cd = 'appname'") ;
while ($db = mysqli_fetch_array($hasil)) { $cc = $db['cc'] ;}

if ($cc==0) {mysqli_query($koneksi, "INSERT INTO tmp (tmp_cd, tmp_val) VALUES ('appname', 'wg')") ;}

mysqli_query($koneksi, "update tmp set tmp_val = 'wg' where tmp_cd = 'appname' and tmp_val = '-' ") ;
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
		(SELECT count(1) FROM autorespon WHERE profil = '$profil') autorespon,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = '$status00' ) status,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = 'wagent' ) wagent,
		(SELECT count(1) FROM web_user) user, 
		(SELECT qr from web_user where id = '$profil') qr,
		(SELECT status from web_user where id = '$profil') full,
		(SELECT concat( wa_user, ' | ' , wa_no) from web_user where id = '$profil') uid,
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
		(SELECT count(1) FROM autorespon WHERE profil = '$profil') autorespon,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = '$status00' ) status,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = 'wagent' ) wagent,
		(SELECT count(1) FROM web_user ) user, 
		(SELECT qr from web_user where id = '$profil') qr,
		(SELECT status from web_user where id = '$profil') full,
		(SELECT concat( wa_user, ' | ' , wa_no) from web_user where id = '$profil') uid,
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
$uid		= $db['uid'] ;
$full		= $db['full'] ;
}

if ($status == '' ) { $status = 'Not Connect' ;}
?>
<!DOCTYPE html>
<html lang="en" class="notranslate" translate="no">
<head><meta name="google" content="notranslate" /> </head>
   <!--<![endif]--><!-- START @HEAD -->
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!-- START @META SECTION -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="author" content="wawn1782 | DPSoft.ID">
      <title><?echo $appname ?> | Web App</title>
      <link rel="shortcut icon" href="../wg_files/wa.ico"> 
      <!--/ END META SECTION -->
      <!-- START @GLOBAL MANDATORY STYLES -->
      <!--link href="http://localhost/bc/bcfiles/bootstrap.css" rel="stylesheet"-->
      <link href="../wg_files/bootstrap.min.css" rel="stylesheet">
      <!--/ END GLOBAL MANDATORY STYLES -->
      <!-- START @PAGE LEVEL STYLES -->
      <link href='../wg_files/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
      <link href="../wg_files/animate.css" rel="stylesheet">
      <link href="../wg_files/xxdatepicker.css" rel="stylesheet">
      <link href="../wg_files/xxbootstrap-colorpicker.min.css" rel="stylesheet">
      <link href="../wg_files/daterangepicker.css" rel="stylesheet">
      <link href="../wg_files/xxbootstrap-wysihtml5.css" rel="stylesheet">
      <!--/ END PAGE LEVEL PLUGINS -->
      <!-- START @THEME STYLES -->
      <link href="../wg_files/xxreset.css" rel="stylesheet">
      <link href="../wg_files/layout.css" rel="stylesheet">
      <link href="../wg_files/components.css" rel="stylesheet">
      <link href="../wg_files/xxplugins.css" rel="stylesheet">
      <link href="../wg_files/red.css" rel="stylesheet" id="theme">
      <link href="../wg_files/xxcustom.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="../wg_files/component.css">
       

	 <!-- POPUP -->	  
		<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
		<script>
			$(document).ready(function() {
				$('#Popup').click(function() {
					var newwindow = window.open($(this).prop('href'), '', 'height=500,width=800');
					if (window.focus) {
						newwindow.focus();
					}
					return false;
				});

				$('#NewTab').click(function() {
					$(this).target = "_blank";
					window.open($(this).prop('href'));
					return false;
				});
			});
		</script>  
		
		
	  
      <!--/ END THEME STYLES -->

      <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}
         .table{width:99.9%;margin-bottom:20px;  background-color: white ;}.table th,.table td{font-size: 11px; padding:8px;line-height:17px;vertical-align:top;border-top:1px solid #dddddd;}
         .table th{font-weight:bold;font-size: 11px; /*background-color: #862E5E; color: #FFF;*/}
         .table thead th{vertical-align:bottom;}
         .table caption+thead tr:first-child th,.table caption+thead tr:first-child td,.table colgroup+thead tr:first-child th,.table colgroup+thead tr:first-child td,.table thead:first-child tr:first-child th,.table thead:first-child tr:first-child td{border-top:0;}
         .table tbody+tbody{border-top:1px solid #dddddd;}
         .table-striped tbody tr:nth-child(odd) td,.table-striped tbody tr:nth-child(odd) th{background-color:#f6f6f6 /*#f9f9f9*/;}
         .table-hover tbody tr:hover td,.table-hover tbody tr:hover th{background-color:#00bdf0; color:#FFFFFF;}
         table [class*=span],.row-fluid table [class*=span]{display:table-cell;float:none;margin-left:0;}
         .table-fixed thead {
         width: 100%;
         }
         .table-fixed tbody {
         height: 230px;
         overflow-y: auto;
         width: 100%;
         }
         .table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
         display: block;
         }
         .table-fixed tbody td, .table-fixed thead > tr> th {
         float: left;
         border-bottom-width: 0;
         }
         .nicescroll-rails {
         visibility:hidden;
         }
         #header .navbar-center {
         float: center; }
		 .spinner {
			position: fixed;
			top: 50%;
			left: 50%;
			margin-left: -50px;
			margin-top: -50px;
			text-align: center;
			z-index: 1234;
			overflow: auto;
			width: 100px;
			height: 102px;
		}
      </style>
   </head>
   <!--/ END HEAD -->
   <!--<body class="wysihtml5-supported">-->
   <body class="page-footer-fixed" style="background-color: #eeeeef;">
   <!--<body class="page-sidebar-minimize page-sidebar-fixed page-footer-fixed" style="background-color: #eeeeef;">-->
      <!--[if lt IE 9]>
      <p class="upgrade-browser">Upps!! You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->
      <!-- START @WRAPPER -->
      <section id="wrapper">
      <!-- START @HEADER -->
      <header id="header">
         <!-- Start header left -->
         <div class="header-left">
            <!-- Start offcanvas left: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
            <div class="navbar-minimize-mobile left">
               <i class="fa fa-bars"></i>
            </div>
            <!--/ End offcanvas left -->
            <!-- Start navbar header -->
            <div class="navbar-header">
               <!-- Start brand -->
               <a class="navbar-brand" href="../home" >
               <img class="logo" src="../wg_files/<? echo $logo_left ; ?>">
               </a><!-- /.navbar-brand -->
               <!--/ End brand -->
			    
 
  
            </div>
            <!-- /.navbar-header -->
            <!--/ End navbar header -->
 
            <div class="clearfix"></div>
         </div>
         <!-- /.header-left -->
         <!--/ End header left -->
         <!-- Start header right -->
         <div class="header-right">
            <!-- Start navbar toolbar -->
            <div class="navbar navbar-toolbar navbar-dark" style="font-family:&#39;Open Sans&#39;, sans-serif;font-weight: 400px;">
               <!-- Start left navigation -->
               <ul class="nav navbar-nav navbar-left">
                  <!-- Start sidebar shrink -->
                  <li class="navbar-minimize">
                     <a href="javascript:void(0);" title="Minimize sidebar">
                     <i class="fa fa-bars"></i>
                     </a>
                  </li>
               </ul>
               <ul class="nav navbar-nav navbar-center" style=" display: block;;">
                  <center> <img class="logo" src="../wg_files/<? echo $logo_text ; ?>" alt="brand logo"> </center>
               </ul>
               <!-- /.navbar-left -->					  
          <ul class="nav navbar-nav navbar-right" style="margin-top:5px;margin-right:20px;">
                  <li class="navbar-settings pull-right">
				  <div>
<? if ($multi == 'yes') { ?>

<a href="../profile" class="btn btn-primary" style="padding: 6px 12px;"> 
  Profile <span class="badge badge-light"><? echo $profil ?></span>
  <span  class="badge badge-light" style="color: 0;font-size: 18px;padding:1px;padding-right:10px;padding-left:10px; font-weight:400;"><? echo $uid ?></span> 
</a>

<? } ?>


<span id="status" >
<?
$trial = 'Y' ;
if ($sent > $user_trial_limit) { $labeltrial = "BUY FULL VERSION !!" ; $trialend = 'Y' ; } else { $labeltrial = "TRIAL $sent/$user_trial_limit" ; $trialend = 'N' ;} 
if ($profil == 0 ) {$trial = 'N' ; }
if ($full == 'Y' ) {$trial = 'N' ; $trialend = 'N' ;}
if ( $trial == 'Y' ) {
?>
<a href='https://api.whatsapp.com/send?phone=<? echo $admin_wa ?>' target="_blank">
<button type="button" class="btn btn-warning"> <? echo $labeltrial ; ?>  </button>
</a>
<? } ?>
<a href="../home"> 
<button type="button" class="btn btn-<? if ($status=='Ready') {echo 'primary' ;} else {echo 'danger' ;} ?>"> <? echo $status ; ?>  </button>
</a>
</span>

</div>
                  </li>
                  <!-- /.navbar-setting -->
                  <!--/ End settings -->
               </ul> 
            </div>
            <!-- /.navbar-toolbar -->					
            <!--/ End navbar toolbar -->
         </div>
         <!-- /.header-right -->
         <!--/ End header left -->
      </header>
      <!-- /#header -->
      <!--/ END HEADER -->
      <aside id="sidebar-left" class="sidebar-circle sidebar-profile" style="background-color: #2A2A2A;">
         <!-- Start left navigation - menu -->		 
		  <ul class="sidebar-menu" style="font-size: 12px;">
		  
            <li class="menu">
               <a href="../home">
               <span class="icon"><i class="fa fa-qrcode"></i></span>
               <span class="text">DEVICE</span><span class="pull-right badge badge-light"><? echo $status  ; ; ?>
               </a>
            </li>
<? if ($profil != '0') { ?>
            <li class="submenu active">
               <a href="javascript:void(0);">
               <span class="icon"><i class="fa fa-th-large"></i></span>
               <span class="text">TABLES</span>
               <span class="arrow"></span>                             
               </a>
               <ul>
				  <li><a href="../outbox">OUTBOX&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-teal" style="background-color: #37BC9B;"><? echo number_format($outbox) ; ?></span></a></li>
				  <li><a href="../scheduled">SCHEDULED&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-teal" style="background-color: #37BC9B;"><? echo number_format($scheduled) ; ?></span></a></li>
                  <li><a href="../inbox">INBOX&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-success"><? echo number_format($inbox) ; ?></span></a></li>
                  <li><a href="../sent">SENT&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-primary"><? echo number_format($sent) ; ?></span></a></li>
                  <li><a href="../fail">FAIL&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-danger"><? echo number_format($fail) ; ?></span></a></li>
				  <? if ($hide_sms != 'Y') { ?>
				  <li><a href="../outboxsms">SMS OUTBOX&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-xx"><? echo number_format($sms) ; ?></span></a></li>
				  <? } ?>
               </ul>
            </li>			
 
           <li class="sidebar-category">
               <span>SEND</span>
               <span class="pull-right"><i class="fa fa-comment"></i></span>
            </li>
            <li class="menu">
               <a href="../send">
               <span class="icon"><i class="fa fa-paper-plane"></i></span>
               <span class="text">SINGLE MESSAGE</span>                            
               </a>  
            </li>
             <li class="menu">
               <a href="../send2">
               <span class="icon"><i class="fa fa-bell-o"></i></span>
               <span class="text">SCHEDULED MESSAGE</span>
               </a>
            </li>				
            <li class="menu">
               <a href="../blast">
               <span class="icon"><i class="fa fa-bullhorn"></i></span>
               <span class="text">BROADCAST / BULK</span>
               </a>
            </li>
          <!--  <li class="menu">
               <a href="../boom">
               <span class="icon"><i class="fa fa-bomb"></i></span>
               <span class="text">BOOM MESSAGE</span>
               </a>
            </li> -->
			
			<? if ($hide_sms != 'Y') { ?>
            <li class="menu">
               <a href="../sms">
               <span class="icon"><i class="fa fa-comments"></i></span>
               <span class="text">SMS</span>
               </a>
            </li>			
			<? } ?>
			
			<? } ?>
            <li class="submenu active">
               <a href="javascript:void(0);">
               <span class="icon"><i class="fa fa-wrench"></i></span>
               <span class="text">CONFIGURATION</span>
               <span class="arrow"></span>                             
               </a>
               <ul>
			<? if ($profil == '0') { ?>
				  <li><a href="../user">User Management&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-xx"><? echo number_format($user) ; ?></span></a></li> 
			<? } ?>	
			<? if ($profil != '0') { ?>
				<li><a href="../bot">Bot Config & API</a></li> 				  				  
				<li><a href="../autoresponder">Auto Responder&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-xx"><? echo number_format($autorespon) ; ?></span></a></li>  
				<li><a href="../profile">My Profile</a></li> 	
		  <? } ?>				   
               </ul>	
            </li>
			

			
         </ul>
         <!-- /.sidebar-menu -->
         <!--/ End left navigation - menu -->
         <!-- Start left navigation - footer -->
         <div class="sidebar-footer hidden-xs hidden-sm hidden-md">
            <a title="" data-original-title="" id="fullscreen" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Fullscreen"><i class="fa fa-desktop"></i></a>
            <a title="" data-original-title="" class="pull-left" href="../login/logout.php" data-toggle="tooltip" data-placement="top" data-title="Log out"><i class="fa fa-power-off"></i></a>
         </div>
         <!-- /.sidebar-footer -->
         <!--/ End left navigation - footer -->
      </aside>
      <!-- /#sidebar-left -->
      <!--/ END SIDEBAR LEFT -->
      <!-- START @PAGE CONTENT -->
      <section id="page-content">


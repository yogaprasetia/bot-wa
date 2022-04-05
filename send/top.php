<?php 
include '../konfig.php' ;
if ($multi == 'yes') {	if (!isset($_SESSION['profil'])){ header("Location:../login") ; } }   

if ($multi != 'yes') {
		$hasil = mysqli_query($koneksi, "
		SELECT 
		(SELECT count(1) FROM outbox) outbox,
		(SELECT count(1) FROM inbox) inbox,
		(SELECT count(1) FROM sent WHERE status IS null) sent,
		(SELECT count(1) FROM sent WHERE NOT status IS null) fail,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = '$status00' ) status,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = 'wagent' ) wagent,
		tmp_val app_name 
		FROM tmp 
		WHERE tmp_cd = 'appname'
		" );  
} else {
		$hasil = mysqli_query($koneksi, "
		SELECT 
		(SELECT count(1) FROM multi WHERE tipe = 'O' AND profil = '$profil') outbox,
		(SELECT count(1) FROM multi WHERE tipe = 'I' AND profil = '$profil') inbox,
		(SELECT count(1) FROM multi WHERE tipe = 'S' AND profil = '$profil' AND status IS null) sent,
		(SELECT count(1) FROM multi WHERE tipe = 'S' AND profil = '$profil' AND NOT status IS null) fail,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = '$status00' ) status,
		(SELECT tmp_val FROM tmp WHERE tmp_cd = 'wagent' ) wagent,
		tmp_val app_name 
		FROM tmp 
		WHERE tmp_cd = 'appname'
		" );  	
}
while ($db = mysqli_fetch_array($hasil))
{
$outbox = $db['outbox'] ;	
$inbox 	= $db['inbox'] ;
$sent 	= $db['sent'] ;
$fail 	= $db['fail'] ;
$status	= $db['status'] ;
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
      <title>WA-GW | Web App</title>
      <link rel="shortcut icon" href="../wg_files/g.ico"> 
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
  

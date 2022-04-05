<?php include '../konfig.php' ;?> 


<script>  
 function reset()    
 { 
  $.ajax({
	url: "reset.php" ,  		
	success: function(data){ 
	alert('Draft Table Reseted..') ;
	window.location.reload() ;
	}         
	});       
 }        

 function blast()    
 { 
 $.ajax({
	url: "blast.php" ,  		
	success: function(data){ 
	alert('Transfer to OUTBOX Succeed') ;
	window.location.reload() ;
	}         
	});       
 }      
   
</script> 

 <div class="body-content">
<div class="row">



						<div class="col-md-12">
                            <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title"><i class="fa fa-bullhorn"></i>  BROADCAST / BULK SMS</h3>										 
                                    </div>
									 <div class="pull-right">
									 <a href="../wg_files/smsblast.xls" class="btn btn-success pull-right "><i class="fa fa-file-excel-o"></i> Download XLS Template  </a>
									 </div>
                                   
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
 						
								<div class="panel-body no-padding rounded-bottom">                                    
									<fieldset>
                                        <div class="form-body">
										<!--
                                        <div class="form-group">
                                                <label class="col-sm-2 control-label">Google Sheet URL</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="noreg" >
                                                </div>
                                            <div class="col-sm-1">
                                               <button class="btn btn-success pull-right" type="submit"><i class="fa fa-download"></i> Import</button>
                                            </div>													
                                        </div><!-- /.form-group -->		
										<div class="clearfix"></div>
										<form method="post" enctype="multipart/form-data" action="upload_xls.php">
                                        <div class="form-group"  class="form-horizontal form-bordered" >										
                                                <label class="col-sm-2 control-label">Load from XLS File</label>
                                                <div class="col-sm-9">													
                                                    <input class="form-control" type="file" name="filexls" >
                                                </div>
                                            <div class="col-sm-1"> 
											   <button class="btn btn-primary pull-right" type="submit"><i class="fa fa-download"></i> Import</button>
											</div>										
                                        </div>
										</form>											
 
                                        </div><!-- /.form-body -->
								  
										<fieldset>
                                    
 						
                                </div>
 
                                <div class="panel-heading">
                                 <!--   <div class="pull-left">
                                        <h3 class="panel-title"><i class="fa fa-edit"></i>DRAFT</h3>
                                    </div> -->
									<div class="pull-right">
									   <button class="btn btn-primary" onclick="blast()"  <? if ($trialend == 'Y' ) { echo ' disabled ' ; } ?>><i class="fa fa-bullhorn" ></i>  SEND DRAFT TO OUTBOX / BROADCAST</button>
									   <button class="btn btn-danger" onclick="reset()" ><i class="fa fa-bolt"></i>  RESET DRAFT</button>
									</div>									
						   
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
 						
								<div class="panel-body no-padding rounded-bottom">
								
<table class='table table-hover table-condensed table-striped table-bordered'>
    <thead>  
  	   <tr>
	    <th>No.</th>
		<th align='center'><center>Number</center></th>
		<th align='center'><center>Text</center></th>		
		<th align='center'><center>Media</center></th>	
		<th align='center'><center>File</center></th>	
		<th align='center'><center>Time</center></th>		
    </thead>
    <tbody>  

<?
$hasil = mysqli_query($koneksi, "select * from multi where profil = '$profil' and tipe = 'D' and wa_mode = '3' order by id"  ) ;
$no = 0 ;
while ($db = mysqli_fetch_array($hasil))
{
	$wa_time 	= $db['wa_time'] ;		
    $wa_no 		= $db['wa_no'] ;
    $wa_text	= $db['wa_text'] ; 
	$wa_media	= $db['wa_media'] ; 
	$wa_file	= $db['wa_file'] ; 
	$wa_text = str_replace("~r", '<br>', $wa_text ) ;
	$no++ ; 
?>
<tr>
	<td width=30 align='center'  > <? echo $no ; ?> </td>            
	<td width=120> <? echo $wa_no ; ?> </td>   
	<td width=500> <? echo $wa_text ; ?> </td>   
	<td> <? echo $wa_media ; ?> </td>   	
	<td> <? echo $wa_file ; ?> </td>	
	<td width=120 align='center'> <? echo $wa_time ; ?> </td>	
</tr>
<? } ?>	 
	</tbody>
  </table> 
 						
                                </div>
                            </div>
						</div> 

	
						
</div>						

 </div> 
<?
@$mode =  $_SESSION['mode'] ; 
@$cari =  $_GET['cari'] ; 
?>
<script>  
 function reload()    
 { 
     mode = 'N' ;
     if ($("#refresh").is(':checked')) { mode = 'Y' ; }  
 $.ajax({
	url: "setmode.php?mode=" + mode ,  		
	success: function(data){ 
	alert('Mode Refresh Changed..') ;
	window.location.reload() ;
	}         
	});       
 }        

 function reset()    
 { 
  $.ajax({
	url: "reset.php" ,  		
	success: function(data){ 
	alert('Outbox Reseted..') ;
	window.location.reload() ;
	}         
	});       
 }     
  
</script> 

<script type="text/javascript"> 
	<? if ( $mode == 'Y')  { ?> 
	setInterval('window.location.reload()', 2000);   <? }   ?>
</script>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	  
	  
<div class="body-content">
 <div class="col-md-12">
 
  <span class="badge badge-pill badge-secondary"> <? echo date('Y-m-d H:i:s'); ?></span>
  	<span class="ckbox ckbox-theme mt-10">
	<input id="refresh"  value="Y" type="checkbox" onclick="reload()" <? if ($mode=='Y') {echo ' checked ' ; } ?>>
		<label for="refresh"><small>Auto Refresh </small></label>
	</span>
 		<div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                         <b><h3 class="panel-title"><i class="fa fa-clock-o"></i>OUTBOX&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-dark" style="background-color: #777;"><? echo number_format($outbox) ; ?></span></h3></b>
                                    </div>
									<div class="pull-right">									
									<a href = "../send"><button class="btn btn-large btn-primary btn-round"><i class="fa fa-send"></i>  Send Message</button></a>
									<a href = "../blast"><button class="btn btn-large btn-success btn-round"><i class="fa fa-bullhorn"></i>  Send Broadcast</button></a>
									<!--<a href = "../boom"><button class="btn btn-large btn-warning btn-round"><i class="fa fa-bomb"></i>  Send Boom</button></a>-->
									<button class="btn btn-danger" onclick="reset()" ><i class="fa fa-bolt"></i>  RESET OUTBOX </button>
																		
									 </div>
								 
                                    <div class="clearfix"></div>
												<form action="#" method="get">
												<fieldset>
                                                <div class="input-group mb-15">												
                                                    <input class="form-control" type="text" name ="cari" value = "<? echo $cari ?>">												
                                                    <span class="input-group-btn"><button type="submit" class="btn btn-default">Cari</button></span>												 
                                                </div>		
												</fieldset>
												</form>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body">
 
                            <div class="table-responsive mb-20">
 
 								
<table class='table table-hover table-condensed table-striped table-bordered'>
    <thead>  
  	   <tr>
	    <th>No.</th>
		<th align='center'><center>Mode</center></th>
		<th align='center'><center>Number</center></th>
		<th align='center'><center>Text</center></th>		
		<th align='center'><center>Media</center></th>	
		<th align='center'><center>File</center></th>	
		<th align='center'><center>Time</center></th>
		<th align='center'><center>Del</center></th>		
    </thead>
    <tbody>  

<?
$now = date('Y-m-d H:i:s') ; 
if ($multi != 'yes') {
$hasil = mysqli_query($koneksi, "select * from outbox where wa_mode <> '3' and wa_time <= '$now' and concat(wa_no,wa_text) like '%$cari%'  order by id"  ) ;}
else{
$hasil = mysqli_query($koneksi, "select * from multi where  profil = '$profil' and tipe = 'O'  and wa_mode <> '3' and wa_time <= '$now' and  concat(wa_no,wa_text) like '%$cari%' order by id"  ) ;}
	
$no = 0 ;
while ($db = mysqli_fetch_array($hasil))
{	$id 		= $db['id'] ;		
	$wa_time 	= $db['wa_time'] ;	
	$wa_mode 	= $db['wa_mode'] ;	
    $wa_no 		= $db['wa_no'] ;
    $wa_text	= $db['wa_text'] ; 
	$wa_media	= $db['wa_media'] ; 
	$wa_file	= $db['wa_file'] ; 
	$wa_text = str_replace("~r", '<br>', $wa_text ) ;
	$no++ ; 
	
	$wa_media = str_replace( $path_upload, '', $wa_media ) ;
	$wa_file = str_replace( $path_upload, '', $wa_file ) ;
?>
<tr>
	<td width=30 align='center'  > <? echo $no ; ?> </td>      
	<td width=30 align='center'  > <? echo $wa_mode ; ?> </td> 	
	<td width=120> <? echo $wa_no ; ?> </td>   
	<td width=500> <? echo $wa_text ; ?> </td>   
	<td> <? echo $wa_media ; ?> </td>   	
	<td> <? echo $wa_file ; ?> </td>	
	<td width=120 align='center'> <? echo $wa_time ; ?> </td>
	<td width=10 align='center'  >  
	<a href="delete.php?id=<? echo $id ?>" data-toggle="tooltip" data-placement="top" onclick="return confirm('Are you sure you want to delete this?')" title="" data-original-title="delete"><button><i class='fa fa-trash-o'></i></button> </a>
	</td>
</tr>
<? } ?>	 
	</tbody>
  </table> 
 
                            </div><!-- /.table-responsive -->
                            <!--/ End table with actions -->

                                </div><!-- /.panel-body -->
</div> </div>
                            					                  


</div>


<?php include '../konfig.php' ;?> 
 
 <div class="body-content">
<div class="row">



						<div class="col-md-12">
                            <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title"><i class="fa fa-exchange"></i> AUTO RESPONDER</h3>										 
                                    </div>
									 <div class="pull-right">
									 <a href="../wg_files/autorespon.xls" class="btn btn-success pull-right "><i class="fa fa-file-excel-o"></i> Download XLS Template  </a>
									 </div>
                                   
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
 						
								<div class="panel-body no-padding rounded-bottom">                                    
									<fieldset>
                                        <div class="form-body">
 	
										<div class="clearfix"></div>
										<form method="post" enctype="multipart/form-data" action="upload_xls.php">
                                        <div class="form-group"  class="form-horizontal form-bordered" >										
                                                <label class="col-sm-3 control-label">Load Data Auto Respon from Excel File &nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                <div class="col-sm-7">													
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
 
 						
								<div class="panel-body no-padding rounded-bottom">
								
<table class='table table-hover table-condensed table-striped table-bordered'>
    <thead>  
  	   <tr>
	    <th>No.</th>
		<th align='center'><center>Keyword</center></th>
		<th align='center'><center>Answer</center></th>	 	
		<th align='center'><center>Logic</center></th>	 
    </thead>
    <tbody>  

<?
$hasil = mysqli_query($koneksi, "select * from autorespon where profil='$profil' order by keyword"  ) ;
$no = 0 ;
while ($db = mysqli_fetch_array($hasil))
{
	$keyword 	= $db['keyword'] ;		
    $answer 	= $db['answer'] ; 
	$logic 	= $db['logic'] ; 
	$answer = str_replace("~r", '<br>', $answer ) ;
	$no++ ; 
?>
<tr>
	<td width=30 align='center'  > <? echo $no ; ?> </td>            
	<td> <? echo $keyword ; ?> </td>   
	<td> <? echo $answer ; ?> </td>  
	<td width=30 align='center' > <? echo $logic ; ?> </td>  
	
</tr>
<? } ?>	 
	</tbody>
  </table> 
 						
                                </div>
                            </div>
						</div> 

	
						
</div>						

 </div> 
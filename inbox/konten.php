<script>  
 function scr()
 {  $.ajax({
	url: "do.php?format=scr&awal=" + $("#awal").val() + "&akhir=" + $("#akhir").val() +  "&cari=" + $("#cari").val() ,   
	beforeSend: function() {
		$("#spinner").html('<img src="../wg_files/loading.gif"  alt="Loading">');
	},
	complete: function() {
		$("#loader").html('');
	},		
	success: function(data){ 
		$("#isi").html(data);	
		$("#spinner").html('');
	}         
	});       
 }    
  
function xls()
 { 
    url = "do.php?format=xls&awal=" + $("#awal").val() + "&akhir=" + $("#akhir").val() + "&klas=" + $("#klas").val()  +  "&cari=" + $("#cari").val() ;   
	window.open( url ); 
 }     
 
 
 
 $(function() {
    scr();
});

</script> 

	  
<div class="body-content">

<? if ($trialend == 'Y' ) { ?> 
						<div class="alert alert-danger alert-dismissible">
						  <a href='https://api.whatsapp.com/send?phone=<? echo $admin_wa ?>' target="_blank" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong> Your Free Trial is Over</strong> <br>Please contact Admin to get Full Access..
						</div> 
<?
exit ; } ?>
	
   <div class="col-md-16">
      <div class="panel rounded shadow panel-scrollablez">
         <div class="panel-heading">
            <div class="pull-left">
               <h3 class="panel-title"><i class="fa fa-download"></i><strong>INBOX</strong></h3>
            </div>
            <div class="clearfix"></div>
         </div>
         <!-- /.panel-heading -->
         <div class="panel-sub-heading">
 
                  <div class="row inner-all">
                     <input name="id" type="hidden" value="0">
                     <div class="form-body"  style="margin-top:-10px;">
           
                                
<form class="form-inline">					 
	<div class="form-group">  
		<label>&nbsp;Period</label>													
		<div>
			<input id="awal" name="awal" class="form-control date-range-picker-single" data-date-format="yyyy-mm-dd" value="<? echo date('Y-m') . '-01' ;?>" type="text">
			 -s/d-
			<input id="akhir" name="akhir" class="form-control date-range-picker-single" data-date-format="yyyy-mm-dd" value="<? echo date('Y-m-d') ;?>" type="text">
		</div>			
    </div> 
 
 
	
	<div class="form-group">		
		<label> &nbsp;Filter</label>		
		<div class="input-icon right">
			<i class="fa fa-search"></i>
			 <input class="form-control" type="text" id="cari" name="cari" value="" placeholder="Filter Data / Search Text..">	
		</div>		  
	</div> 		
 
                        <div class="form-group" style="padding-bottom:0px;padding-top:20px;">
 
                              <div class="pull-right" style="padding-top:5px;"> 
                                 <a class="btn btn-expand btn-primary" style="width:140px;" name="scr" id="scr" onclick="scr()"><i class="fa fa-desktop"></i>&nbsp;Show</a>                                 
                                <a class="btn btn-expand btn-success" style="width:140px;" name="xls" id="xls" onclick="xls()"><i class="fa fa-file-excel-o"></i>&nbsp;Export XLS</a>
                              </div>
                           </div>
											
</form>
						

                        </div>
                        <!-- /.form-group -->	  
                     </div>
                     <!-- /.form-body --> 
                  
                  <div class="clearfix"></div>
               
            
         </div>
         <!-- /.panel-sub-heading -->		 
         <div class="panel-body">		 
			 <div id="spinner" class="spinner">		
				<img src="../wg_files/loading.gif"  alt="Loading">			 
			</div>
		
            <!--<div id = "isi" class="table-responsive" style="height: 360px; overflow: auto; ">
			<div id = "isi" class="table-responsive" style="height:600px; overflow: auto; ">-->
			<div id = "isi" style="height: 57vh; width:auto;overflow: auto; "> 
 
				 <div class="col-sm-12">
					<!-- PAGE CONTENT BEGINS -->

					<!-- #section:pages/error -->
					<div class="error-container">
						<div class="well">
							<h3 class="grey lighter smaller">
								<span class="blue bigger-125">
									<i class="ace-icon fa fa-info-circle"></i>									
								</span>
								Table Inbox
							</h3>

							<hr />
							<div>
							 
								<ul class="list-unstyled spaced inline bigger-110 margin-15">
									<li>
										<i class="fa fa-toggle-right"></i>					
Specify the period to be viewed, fill in the filter if you want to filter, then click Show
									</li>
									<li>
										<i class="fa fa-toggle-right"></i>										
Click Export to XLS to download the report in XLS format
									</li>
								</ul>
							</div>
							<hr />
						</div>
					</div>

					<!-- /section:pages/error -->

					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
		 
			
            </div>
         </div>
         <!-- /.panel-body -->
      </div>
   </div>
   <script>

</script>

</div>


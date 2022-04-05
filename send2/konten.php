<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 1500);
    });    
</script>

 <?php include '../konfig.php' ;
 @$ok =  $_GET["ok"] ; 
 ?> 
 <div class="body-content animated fadeIn">
<div class="row">
						<div class="col-md-12">
                            <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title"><i class="fa fa-bell-o"></i>SEND SCHEDULED MESSAGE</h3>
                                    </div>
                                   
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
 						
								<div class="panel-body no-padding rounded-bottom">
                                    <form action="send.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data" >
									<fieldset>
                                        <div class="form-body">
										
<? if($ok=='yes') { ?>											
<div class="alert alert-info alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Your Message insert into Scheduled Queu..
</div>
<? } ?>

 
                                        <div class="form-group">
										   <label class="col-sm-3 control-label"> Scheduled Send Date</label>
										   <div class="col-sm-2">
											  <input id="tgl" name="tgl" class="form-control date-range-picker-single" data-date-format="yyyy-mm-dd" value="<? echo date('Y-m-d') ; ?>" type="text">
										   </div>
										   <label class="col-sm-1 control-label"> Time</label>
										   <div class="col-sm-2">
											  <input  class="form-control" type="time" id="jam" name="jam" value="<? echo date('H:i') ; ?>">
										   </div>										   
                                        </div><!-- /.form-group -->		
										
                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">Whatsapp Number /<br>Contact or Group Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="wa_no" >
                                                </div>
                                        </div><!-- /.form-group -->		

                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">Message</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="wa_text" rows="11"></textarea>
                                                </div>
                                        </div><!-- /.form-group -->	
										
                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">Attach Media / File</label> 
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="file" name="file" >
                                                </div>
                                        </div><!-- /.form-group -->		
 
                                        </div><!-- /.form-body -->
								 
		 
                                        <div class="form-footer">
                                            <div class="pull-right">
                                               <button class="btn btn-primary" type="submit"  <? if ($trialend == 'Y' ) { echo ' disabled ' ; } ?> >SEND MESSAGE</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div><!-- /.form-footer -->
										<fieldset>
                                    </form>
 
						
                                </div><!-- /.panel-body --> 
                            </div><!-- /.panel -->
                    </div><!-- /.row -->
</div>						
 </div> 
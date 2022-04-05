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
                                        <h3 class="panel-title"><i class="fa fa-bomb"></i>BOOM MESSAGE</h3>
                                    </div>
                                   
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
 						
								<div class="panel-body no-padding rounded-bottom">
                                    <form action="send.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data" >
									<fieldset>
                                        <div class="form-body">
										
<? if($ok=='yes') { ?>											
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Your Message insert into Outbox Queu..
</div>
<? } ?>
 										
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
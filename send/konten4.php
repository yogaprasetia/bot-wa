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
@$id =  $_GET["id"] ; 
 
if ($multi != 'yes') {
$hasil = mysqli_query($koneksi, "select * from sent where id = '$id'"  ) ;}
else {
$hasil = mysqli_query($koneksi, "select * from multi where profil = '$profil' and tipe = 'S' and  id = '$id'" ) ;}
 
while ($db = mysqli_fetch_array($hasil))
{
    $wa_no 		= $db['wa_no'] ;
    $wa_text	= $db['wa_text'] ; 
}
?>

<? if($ok=='yes') { ?>											
<script>
 window.close();   // Closes the new window
 alert ('Your Message insert into SMS Outbox Queue..') ;
</script>
<? } ?>

 <div class="body-content animated fadeIn">
<div class="row">
						<div class="col-md-12">
                            <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title"><i class="fa fa-comments"></i>RESEND USING SMS</h3>
                                    </div>
                                   
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
 						
								<div class="panel-body no-padding rounded-bottom">
                                    <form action="sendsms.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data" >
									<fieldset>
                                        <div class="form-body">
										 										
                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">Phone Number</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="wa_no" value='<? echo $wa_no ?>'>
                                                </div>
                                        </div><!-- /.form-group -->		

                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">Message</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="wa_text" rows="3" ><? echo $wa_text ?></textarea>
                                                </div>
                                        </div><!-- /.form-group -->											
 
		 
                                        <div class="form-footer">
                                            <div class="pull-right">
											   <button class="btn btn-danger" onclick="window.close()">CANCEL</button>
                                               <button class="btn btn-primary" type="submit">SEND MESSAGE</button>
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
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
 
 
$hasil = mysqli_query($koneksi, "select * from web_user where id = '$profil' ") ; 
while ($db = mysqli_fetch_array($hasil))
{
    $wa_user		= $db['wa_user'] ;  
	$wa_no 			= $db['wa_no'] ;  
	$email 			= $db['email'] ;  
	$password		= $db['password'] ;
	$disableread	= $db['disable_read'] ;
}

 ?> 
 <div class="body-content animated fadeIn">
<div class="row">
						<div class="col-md-12">
                            <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title"><i class="fa fa-user"></i> My Profile</h3>
                                    </div>
                                   
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
 						
								<div class="panel-body no-padding rounded-bottom">
                                    <form action="update.php" method="post" class="form-horizontal form-bordered">
									<fieldset>
                                        <div class="form-body">
										
<? if($ok=='yes') { ?>											
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Your Profile Updated..
</div>
<? } ?>

<? if($ok=='no') { ?>											
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>ERROR!</strong> Failed to Update
</div>
<? } ?>

                                        <div class="form-group">
                                                <label class="col-sm-4 control-label"># Profil </label>
                                                <div class="col-sm-1">
                                                    <input class="form-control" type="text" name="profil"   value="<? echo $profil ?>" disabled >
                                                </div>
                                        </div><!-- /.form-group -->	
										
                                        <div class="form-group">
                                                <label class="col-sm-4 control-label">User Name</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="user_name"  value="<? echo $wa_user ?>"  disabled >
                                                </div>
                                        </div><!-- /.form-group -->		
										
										
                                        <div class="form-group">
                                                <label class="col-sm-4 control-label">My Email</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="email" disabled  value="<? echo $email ?>" >
                                                </div>
                                        </div><!-- /.form-group -->	
										
                                        <div class="form-group">
                                                <label class="col-sm-4 control-label">My Whatsapp Number <span style="color:red;">(with country code)<span></label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="wa_no"  value="<? echo $wa_no ?>" >
                                                </div>
                                        </div><!-- /.form-group -->		

	

                                        <div class="form-group">
                                                <label class="col-sm-4 control-label">My Password</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="password"  value="<? echo $password ?>"  >
                                                </div>
                                        </div><!-- /.form-group -->	
										


										<div class="form-group" style="background-color:#e6e6e6;">
										  <label class="col-md-4 control-label" for="disableread" style="margin-top:-5px;">DISABLE READ MODE</label>  
										  <div class="col-md-6">
										  
											  <div class="radio">
											  <label for="bot-1">
												  <input type="radio" name="disableread" id="bot-1" value="N"  <? if ($disableread == 'N') { echo ' checked ' ; } ?>>
												  NO
												</label>&nbsp;&nbsp;&nbsp;&nbsp;	
												<label for="bot-0">
												  <input type="radio" name="disableread" id="bot-0" value="Y" <? if ($disableread == 'Y') { echo ' checked ' ; } ?> >
												  YES
												</label>
													

												</div><br>
												<small>if YES, you cannot receive messages and the bot will also be disabled ..<br>This setting is best if you only want to Blast / Send Bulk </small>
										  </div>
										</div>
											
                                        <div class="form-footer">
                                            <div class="pull-right">
                                               <button class="btn btn-primary" type="submit" <? if ($wa_user == 'demo') {echo ' disabled ' ; } ?>>UPDATE MY PROFILE</button>
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
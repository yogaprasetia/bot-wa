<?php 
include '../konfig.php' ; 
@$ok =  $_GET["ok"] ; 


$hasil = mysqli_query($koneksi, "select * from web_user where id = '$profil' ") ; 
while ($db = mysqli_fetch_array($hasil))
{
    $bot 		= $db['bot_mode'] ;  
	$url 		= $db['bot_url'] ;  
	$token 		= $profil . $db['password'] ;  
	$pass 		= $db['password'] ;
	$wa			= $db['wa_no'] ;
	$disable_read = $db['disable_read'] ;
}


if ($profil != 0 ) { ?>
 
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 1500);
    });
</script>

<? } ?>

  

<div class="body-content">

<? if ($trialend == 'Y' ) { ?> 
						<div class="alert alert-danger alert-dismissible">
						  <a href='https://api.whatsapp.com/send?phone=<? echo $admin_wa ?>' target="_blank" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong> Your Free Trial is Over</strong> <br>Please contact Admin to get Full Access..
						</div> 
<?
exit ; } ?>

<div class="row">
 						<div class="col-md-12">
						
 						<? if($profil=='0') {	 ?>								
						<div class="alert alert-danger alert-dismissible">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Info!</strong> Your Profil = 0<br>You can not make any change of Bot..
						</div>
						<? } ?>	
						
 						<? if($profil!='0' AND $disable_read == 'Y') {	 ?>								
						<div class="alerxt alert-danger">
						 
						  <strong>Info!</strong> DISABLE READ is ON<br>You cannot receive any message and run the Bot, Please edit in Profile settings 
						</div>
						<? } ?>							

<? if($profil!='0') {	 ?>								
                            <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title"><i class="fa fa-code"></i>BOT CONFIGURATION</h3>
                                    </div>
									 <div class="pull-right">
									 <a href="../bots/bots.zip" class="btn btn-success pull-right "><i class="fa fa-code"></i> Download Sample Bots / WEBHOOK Files here </a>
									 </div>                    
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
								
								
 						<? if($ok=='yes') {	 ?>								
						<div class="alert alert-info alert-dismissible">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Success!</strong> Bot Config Updated..
						</div>
						<? } ?>	
						
								<div class="panel-body no-padding rounded-bottom">
							
                                    <form action="update.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data" >
									<fieldset>
                                        <div class="form-body">
											
											<div class="form-group">
											  <label class="col-md-4 control-label" for="bot">Bot Config</label>
											  <div class="col-md-4">
											  <div class="radio">
												<label for="bot-0">
												  <input type="radio" name="bot" id="bot-0" value="0" <? if ($bot == 0) { echo ' checked ' ; } ?> >
												  Don't Use Bot
												</label>
												</div>
											  <div class="radio">
												<label for="bot-1">
												  <input type="radio" name="bot" id="bot-1" value="1"  <? if ($bot == 1) { echo ' checked ' ; } ?>>
												  AutoResponder  
												</label>
												</div>
												 
											  <div class="radio">
												<label for="bot-2">
												  <input type="radio" name="bot" id="bot-2" value="2"  <? if ($bot == 2) { echo ' checked ' ; } ?>>
												  SIMI SIMI  
												</label>
												</div>
												 
											  <div class="radio">
												<label for="bot-3">
												  <input type="radio" name="bot" id="bot-3" value="3"  <? if ($bot == 3) { echo ' checked ' ; } ?>>
												  Demo Bot  
												</label>
												</div>	
<!--												
											  <div class="radio">
												<label for="bot-4">
												  <input type="radio" name="bot" id="bot-4" value="4"  <? if ($bot == 4) { echo ' checked ' ; } ?>>
												  Custom Bot by Upload
												</label>
												</div>
-->												
											  <div class="radio">
												<label for="bot-5">
												  <input type="radio" name="bot" id="bot-5" value="5"  <? if ($bot == 5) { echo ' checked ' ; } ?>>
												  My Own Bot in different Host ( WEBHOOK )
												</label>
												</div>
											  </div>
											</div>
 
											<div class="form-group">
											  <label class="col-md-4 control-label" for="urlbot">My URL Bot</label>  
											  <div class="col-md-6">
											  <input id="urlbot" name="urlbot" type="text" value="<? echo $url ?>" class="form-control input-md">
												
											  </div>
											</div>
  
                                        </div><!-- /.form-body -->
								 
		 
                                        <div class="form-footer">
                                            <div class="pull-right">
                                               <button class="btn btn-primary" <? if ($profil == 0) { echo ' disabled ' ; } ?>  type="submit">SAVE BOT CONFIG</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div><!-- /.form-footer -->
										<fieldset>
                                    </form>
 
						
                                </div><!-- /.panel-body --> 
                            </div><!-- /.panel -->
                    </div><!-- /.row -->
					
					

<!--
						<div class="col-md-12">
                            <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title"><i class="fa fa-rocket"></i>  UPLOAD CUSTOM WHATSAPP BOT </h3>										 
                                    </div>
									 <div class="pull-right">
									 <a href="../bots/bots.zip" class="btn btn-success pull-right "><i class="fa fa-code"></i> Download Sample Bot.PHP here </a>
									 </div>
                                   
                                    <div class="clearfix"></div>
                                </div> 

 					<div class="panel-body no-padding rounded-bottom">                                    
									<fieldset>
                                        <div class="form-body">
 	
										<div class="clearfix"></div>
										<form method="post" enctype="multipart/form-data" action="upload_bot.php">
                                        <div class="form-group"  class="form-horizontal form-bordered" >										
                                                <label class="col-sm-3 control-label">Upload Your WA BOT</label>
                                                <div class="col-sm-8">													
                                                    <input class="form-control" type="file" name="filephp" >
                                                </div>
                                            <div class="col-sm-1"> 
											   <button <? if ($profil == 0) { echo ' disabled ' ; } ?> class="btn btn-primary pull-right" type="submit"><i class="fa fa-upload"></i> Upload</button>
											</div>										
                                        </div>
										</form>					 
                                        </div> 
										<fieldset> 
                                </div> 
 
								
								<br>
                            </div>
						</div> 
						
						


						<div class="col-md-12">
                            <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title"><i class="fa fa-plane"></i>  UPLOAD SMS BOT </h3>										 
                                    </div>
									 <div class="pull-right">
									 <a href="../bots/bots.zip" class="btn btn-success pull-right "><i class="fa fa-code"></i> Download Sample Bot.PHP here </a>
									 </div>
                                   
                                    <div class="clearfix"></div>
                                </div> 
 						
								<div class="panel-body no-padding rounded-bottom">                                    
									<fieldset>
                                        <div class="form-body">
 	
										<div class="clearfix"></div>
										<form method="post" enctype="multipart/form-data" action="upload_smsbot.php">
                                        <div class="form-group"  class="form-horizontal form-bordered" >										
                                                <label class="col-sm-3 control-label">Upload Your SMS BOT</label>
                                                <div class="col-sm-8">													
                                                    <input class="form-control" type="file" name="filephp" >
                                                </div>
                                            <div class="col-sm-1"> 
											   <button <? if ($profil == 0) { echo ' disabled ' ; } ?> class="btn btn-primary pull-right" type="submit"><i class="fa fa-upload"></i> Upload</button>
											</div>										
                                        </div>
										</form>					 
                                        </div> 
										<fieldset> 
                                </div> 
 
								
								<br>
                            </div>
						</div> 						
-->
<? } ?>	

						<div class="col-md-12">
                            <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title"><i class="fa fa-question-circle"></i>  API Guide </h3>										 
                                    </div>
 
                                   
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
 						
								<div class="panel-body no-padding rounded-bottom">                                    
									<fieldset>
									 <div class="form-body">
<p><strong>How to Send Whatsapp Using URL ?</strong></p>

<p><strong>With GET Methode</strong></p>

<p>Try sample like this.. Just copy paste to your browser to test</p>
<? 
$host = $_SERVER['HTTP_HOST'] ;  
?>
<pre>
<strong>Send Text Only :</strong>
<code>http://<?echo $host ?>/api/send.php?token=<?echo $token ?>&amp;no=<?echo $wa ?>&amp;text=text-only
http://<?echo $host ?>/api/send.php?token=<?echo $token ?>&amp;no=111,222,333,444,555,etc&amp;text=text-only

<b>OR Using Attach Media/File :</b>
http://<?echo $host ?>/api/send.php?token=<?echo $token ?>&amp;no=<?echo $wa ?>&amp;text=tes&amp;file=http://<?echo $host ?>/online.png</code>

<strong>Send SMS :</strong>
http://<?echo $host ?>/api/sms.php?token=<?echo $token ?>&amp;no=<?echo $wa ?>&amp;text=text-sms
http://<?echo $host ?>/api/sms.php?token=<?echo $token ?>&amp;no=111,222,333,444,555,etc&amp;text=text-sms
</pre>


<pre><strong>Using HTML IFRAME :</strong>
  < iframe src='http://<?echo $host ?>/api/send.php?token=2demo2&no=<?echo $wa ?>&text=Send%20Using%20frame' style='display: none;'></iframe>
</pre>

<pre><strong>Using PHP file_get_contents :</strong>
  $text = urlencode( 'Send Using file_get_contents Methode' ) ;
  file_get_contents("http://<?echo $host ?>/api/send.php?token=<?echo $token ?>&amp;no=<?echo $wa ?>&amp;text=$text") ;</pre>

<pre><strong>Using PHP curl :</strong> 
  $text = urlencode( 'Send Using curl Methode' ) ;
  $url =  "http://<?echo $host ?>/api/send.php?token=1demo&no=<?echo $wa ?>&text=$text" ;
  $ch = curl_init();      
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
  $data = curl_exec($ch);
 
  echo $data ;
  curl_close ($ch);
</pre>


<hr>
<p><strong>You also can send with POST Methode using post.php</strong></p>
<pre>
// Make sure to using Country Code in Phone Number 
$apikey = '<?echo $token ?>';
$phone = '<?echo $wa ?>';
$message = 'This Message is Send Using Post Methode';
$url = 'http://<?echo $host ?>/api/post.php';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_TIMEOUT,30);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, array(
    'Apikey'    => $apikey,
    'Phone'     => $phone,
    'Message'   => $message,
));
$response = curl_exec($curl);
curl_close($curl);
echo $response ; 
</pre>
<hr />
<strong>Your Token = <?echo $token ?><br /></strong>
<p>What is TOKEN ?<br />
Token is&nbsp;&nbsp;your Profil + your Password<br />
If You Want to change your Token.. Just Change Your Password
&nbsp;</p>
</div>
										<fieldset> 
                                </div> 
 
								
								<br>
                            </div>
						</div> 
	
						
</div>						

 </div> 
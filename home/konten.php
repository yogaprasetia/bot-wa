<script>  
 function scr()
 {  
 $.ajax({
	url: "do.php" , 	
	success: function(data){ 
		$("#isi").html(data);  
	}         
	});       
 }    
 
 function sts()
 {  
 $.ajax({
	url: "status.php" , 	
	success: function(data){ 
		$("#status").html(data);  
	}         
	});       
 } 
 
 $(function() {
    scr();
});

</script> 

<script type="text/javascript"> 
	setInterval('scr();sts()', 4000);
</script>

 <div class="body-content"> 
 <? if ($trialend == 'Y' ) { ?> 
						<div class="alert alert-danger alert-dismissible">
						  <a href='https://api.whatsapp.com/send?phone=<? echo $admin_wa ?>' target="_blank" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong> Your Free Trial is Over</strong> <br>Please contact Admin to get Full Access..
						</div> 
<?
exit ; } ?>
<div id = "isi" class="row">			 
</div>
</div>

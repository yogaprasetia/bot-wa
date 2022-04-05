<?
@$cari =  $_GET['cari'] ; 
if( $profil != 0 ) {echo "You don't have autority.." ; exit ; }
?>
<div class="body-content">
 <div class="col-md-12">
 					<div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                         <b><h3 class="panel-title"><i class="fa fa-user"></i> USER MANAGEMENT </h3></b>
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
	    <th>No.</th><th>Profil</th>
		<th align='center'><center>User</center></th>
		<!--
		<th align='center'><center>Password</center></th>	
		<th align='center'><center>WA Number</center></th>
		<th align='center'><center>Email</center></th>	
-->		
		<th align='center'><center>Create Date</center></th>			
		<th align='center'><center>Expire Date</center></th>	
		<th align='center'><center>Manage Expire</center></th>			
		<th align='center'><center>Last Login</center></th>
		<th align='center'><center>Sent</center></th>
		<th align='center'><center>Days Trial</center></th>
		
		<th align='center'><center>Full</center></th>
		
		<th align='center'><center>FULL Access</center></th>		
		<th align='center'><center>Status Connect</center></th>	
		<th align='center'><center>Dis conn</center></th>	
		<th align='center'><center>Del</center></th>		
    </thead>
    <tbody>  

<?
 
$hasil = mysqli_query($koneksi, "select nn.*, (select count(1) from multi aa where tipe = 'S' and aa.profil = nn.id) sent,
(SELECT tmp_val FROM tmp WHERE tmp_cd = CONCAT('status', LPAD(id, 6, 0))) con,
case when status = 'N' then  DATEDIFF(CURRENT_DATE(), create_dt) + 1 else null end  dtrial
from web_user nn 
where concat(wa_user,wa_no,email) like '%$cari%'   order by id"  ) ; 
	
$no = 0 ;
while ($db = mysqli_fetch_array($hasil))
{	$id 		= $db['id'] ;	 
	$wa_user 	= $db['wa_user'] ;	 
    $wa_no 		= $db['wa_no'] ;
    $email		= $db['email'] ; 
	$status		= $db['status'] ;
	$expiry	    = $db['expiry'] ;
	$password	= $db['password'] ; 
	$create_dt	= $db['create_dt'] ; 
	$last_login	= $db['last_login'] ;  
	$sent		= $db['sent'] ;
	$con		= $db['con'] ;
	$days 		= $db['dtrial'] ;
	$no++ ; 	 
	
	if ($con == '' OR $con=='Not Connect') { $con = '-' ; }
?>
<tr>
	<td width=30 align='center'  > <? echo $no ; ?> </td>   
	<td width=30 align='center'  > <? echo $id ; ?> </td>      	
	<td> <? echo $wa_user ; ?> </td> 	
	<!--
	<td> <? echo $password ; ?> </td> 
	<td> <? echo $wa_no ; ?> </td>   
	<td> <? echo $email ; ?> </td>  	
-->	
	<td width=80 align='center'  > <? echo substr($create_dt, 0, 10) ; ?> </td>  		
	<td width=80 align='center'  <? if ($expiry <= date('Y-m-d') ) {echo " style='color:black; background-color:rgb(255,155,155);' " ;} ?>  >   <? echo substr( $expiry ,0,10)  ; ?> </td>	
	<td width=70 align='center'  >  
	<a href="add.php?id=<? echo $id ?>" data-toggle="tooltip" data-placement="top"  onclick="return confirm('ADD Expire Date to <? echo $wa_user ?> ??')"  title="" data-original-title=""><button>+</button> </a>
	<a href="min.php?id=<? echo $id ?>" data-toggle="tooltip" data-placement="top"  onclick="return confirm('MINUS Expire Date to <? echo $wa_user ?> ??')"  title="" data-original-title=""><button>-</i></button> </a>
	</td>		

	<td width=120 align='center'  > <? echo $last_login ; ?> </td>
	
	<td width=30 align='center' style="color:<? if ($sent > $user_trial_limit AND  $status == 'N') {echo 'red' ;} else  {echo 'black' ;}; ?>" > <? echo $sent ; ?> </td>	
	<td width=30 align='center' style="color:<? if ($days > 7) {echo 'red' ;} else  {echo 'black' ;}; ?>"  > <? echo $days ; ?> </td>	
		
	  
	<td width=30 align='center'  <? if ($status == 'Y') {echo " style='color:black; background-color:rgb(0,255,255);' " ;} ?>  > <? echo $status ; ?> </td>
 
	<td width=70 align='center'  >  
	<a href="y.php?id=<? echo $id ?>" data-toggle="tooltip" data-placement="top"  onclick="return confirm('Set FULL ACCESS to <? echo $wa_user ?> ??')" title="" data-original-title=""><button>Y</button> </a>
	<a href="n.php?id=<? echo $id ?>" data-toggle="tooltip" data-placement="top"  onclick="return confirm('Set TRIAL to <? echo $wa_user ?> ??')" title="" data-original-title=""><button>N</i></button> </a>
	</td>	
	
	<td width=30 align='center'  <? if ($con == 'Ready') {echo " style='background-color:rgb(0,255,0);' " ;} ?>  > <? echo $con ; ?> </td> 
	
	<td width=10 align='center'  >  
	<? if ($con!='-') { 
	$id00 = str_pad($id, 6, '0', STR_PAD_LEFT)
	?>
	<a href="off.php?id=<? echo $id ?>&id00=<? echo $id00 ?>" data-toggle="tooltip" data-placement="top" onclick="return confirm('Are you sure you want to DISCONNECT <? echo $wa_user ?> ?')" title="" data-original-title="Disconnect"><button><i class='fa fa-cut'></i></button> </a>
	<? } ?>
	</td>	
	
	<td width=10 align='center'  >  
	<? if ($con=='-') { ?>
	<a href="del.php?id=<? echo $id ?>" data-toggle="tooltip" data-placement="top" onclick="return confirm('Are you sure you want to DELETE <? echo $wa_user ?> ?')" title="" data-original-title="Delete"><button><i class='fa fa-trash-o'></i></button> </a>
	<? } ?>
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


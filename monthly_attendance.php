<?php require_once('header.php');
if(isset($_COOKIE['rememberUser'])){
    $user_id=$_COOKIE['rememberUser'];
        
}
else{
    $user_id = $_SESSION['em_user'][0]['u_id'];
}

 ?>

 <div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Time</th>
                    <th>Attendance</th>
                    <th>Date</th>
                    
                </tr>
            </thead>
             
            <tbody>
            <?php
                $start_date = 1;
                $current_date = date('d');
                for($i=$start_date; $i<=$current_date; $i++){
                	$checkdate = date("Y-m-").$i;
                	if(em_att_submit($checkdate,$user_id)==1):
                	;?>
                	<tr>
	                    <td><?php echo $i; ?></td>
	                    <td><?php echo em_user($user_id,"first_name")." ".em_user($user_id,"last_name"); ?></td>

	                    <td>
	                    	<?php
	                    	 $user_time = checkATTinfo($user_id,$checkdate,'usertime');
	                    	 echo date('h:i A',strtotime($user_time)); 

	                    	 ?>	
	                    	</td>
	                    <td>
	                    	<?php
		                    	$attendacne = checkATTinfo($user_id,$checkdate,'attendance');
		                    	 if($attendacne == 1){
		 							echo "<span class='btn btn-success btn-circle btn-sm'><i class='fas fa-check'></i><span>";               
		                    	 }
		                    	 else{
		                    	 	echo "<span class='btn btn-danger btn-circle btn-sm'><i class='fas fa-times'></i><span>";
		                    	 }


	                    ?>
	                    	
	                    </td>
	                    <td> <?php echo date('d-M-Y',strtotime($checkdate)); ?> </td> 
                	</tr> 
                	<?php else: ?>
                		<tr>
                			<td><?php echo $i; ?></td>
                			<td><?php echo em_user($user_id,"first_name")." ".em_user($user_id,"last_name"); ?></td>
                			<td><?php echo "<span class='btn btn-danger btn-circle btn-sm'><i class='fas fa-times'></i><span>"; ?></td>
                			 <td><?php echo "<span class='btn btn-danger btn-circle btn-sm'><i class='fas fa-times'></i><span>"; ?></td>
                			<td> <?php echo date('d-M-Y',strtotime($checkdate)); ?> </td> 
                		</tr>
                	 <?php endif; 
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
</div>


<?php require_once('footer.php'); ?>
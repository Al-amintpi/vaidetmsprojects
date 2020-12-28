 
<?php require_once('header.php');?>
   <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Today Attendance <?php echo date('d-M-Y h:i A') ?></h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Username</th>
                            <th>Attendance</th>
                            <th>Time</th>
                            <th>Sys time</th>
                            <th>Location</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        	<?php

                        		$stm = $pdo->prepare("SELECT * FROM em_user");
                        		$stm->execute(array());
                        		$result = $stm->fetchAll(PDO::FETCH_ASSOC);
                        		$a = 1;
                        		$today = date('Y-m-d');
                        		foreach($result as $row):

                        	 ?>
                          <tr>
                            <td><?php echo $a;$a++; ?></td>
                            <td><?php echo $row['first_name']." ".$row['last_name'];?></td>
                            <td><?php
                            	$attendacne = em_att_submit($today,$row['u_id']);
                            	if($attendacne==1){
                            		echo '<span class="btn btn-success"><i class="fa fa-check"></i></span>';
                            	}
                            	else{
                            		echo '<span class="btn btn-danger"><i class="fa fa-times"></i></span>';
                            	}

                             ?></td>
                            <td><?php
                            	$attendacne = em_att_submit($today,$row['u_id']);
                            	if($attendacne==1){
                            		$user_time = checkATTinfo($row['u_id'],$today,'usertime');
	                    	 		echo date('h:i A',strtotime($user_time)); 
                            	}
                            	else{
                            		echo '<span class="btn btn-danger"><i class="fa fa-times"></i></span>';
                            	}

                             ?>

                            </td>
                            <td>
                            	<?php
                            	$attendacne = em_att_submit($today,$row['u_id']);
                            	if($attendacne==1){
                            		$user_time = checkATTinfo($row['u_id'],$today,'systemtime');
	                    	 		echo date('h:i A',strtotime($user_time)); 
                            	}
                            	else{
                            		echo '<span class="btn btn-danger"><i class="fa fa-times"></i></span>';
                            	}

                             ?>
                            </td>
                         
                        <td>
                        	<?php
                        	$attendacne = em_att_submit($today,$row['u_id']);
                        	if($attendacne==1){
                        		?>
                        		<a href="#" class="btn btn-success" data-toggle="modal" data-target="#viewModal<?php echo $row['u_id']; ?>"><i class="fa fa-eye"></i> View</a>
                         	 
                         	 <div class="modal fade" id="viewModal<?php echo $row['u_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
					          aria-hidden="true">
					          <div class="modal-dialog" role="document">
					            <div class="modal-content">
					              <div class="modal-header">
					                <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['first_name']." ".$row['last_name'];?> Location</h5>
					                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                  <span aria-hidden="true">&times;</span>
					                </button>
					              </div>
					              <div class="modal-body">
					              	<?php 
					                  $latitude =checkATTinfo($row['u_id'],$today,'latitude');
					                  $longitude =checkATTinfo($row['u_id'],$today,'longitude');
					                  ?>
					                  <iframe style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $latitude; ?>,<?php echo $longitude;?>&amp;key=AIzaSyCw-BKYqt_gpvdrB6kAu30hN8t_jugXaPU" width="100%" height="450" frameborder="0"></iframe>

					              </div>
					               
					            </div>
					          </div>
					        </div>
                        		<?php
                        	}else{
                        		echo '<span class="btn btn-danger"><i class="fa fa-times"></i></span>';
                        	}
                        	 ?>
                        	
                        	
                        </td>
                        <td>
                        	<?php
                        	$attendacne = em_att_submit($today,$row['u_id']);
                        	if($attendacne==1){
                        		?>
                        		<a href="#" class="btn btn-success" data-toggle="modal" data-target="#moreModal<?php echo $row['u_id']; ?>"><i class="fa fa-eye"></i> More</a>
                         	 
                         	 <div class="modal fade" id="moreModal<?php echo $row['u_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
					          aria-hidden="true">
					          <div class="modal-dialog" role="document">
					            <div class="modal-content">
					              <div class="modal-header">
					                <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['first_name']." ".$row['last_name'];?> Details</h5>
					                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                  <span aria-hidden="true">&times;</span>
					                </button>
					              </div>
					              <div class="modal-body">
					              	<?php 
					                  $ip_address =checkATTinfo($row['u_id'],$today,'ip_address');
					                  $devices_details =checkATTinfo($row['u_id'],$today,'devices_details');
					                  ?>
					                   <table class="table">
					                   	<tr>
					                   		<td>Ip Address</td>
					                   		<td><?php echo $ip_address; ?></td>
					                   	</tr>
					                   	<tr>
					                   		<td>Devices Details</td>
					                   		<td><?php echo $devices_details; ?></td>
					                   	</tr>
					                   </table>

					              </div>
					               
					            </div>
					          </div>
					        </div>
                        		<?php
                        	}else{
                        		echo '<span class="btn btn-danger"><i class="fa fa-times"></i></span>';
                        	}
                        	 ?>
                        	
                        	
                        </td>
                          </tr>
                      <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>         
<?php require_once('footer.php'); ?>            
 
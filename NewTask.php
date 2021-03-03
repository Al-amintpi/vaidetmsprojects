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
    <h6 class="m-0 font-weight-bold text-primary">New Task</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task Name</th>
                    <th>Task Details</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
             
            <tbody>
                <?php 

            	$stm = $pdo->prepare("SELECT * FROM em_task WHERE user_id=? AND status!=? ORDER BY t_id ASC; ");
                $stm->execute(array($user_id,"Completed"));
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                $a = 1;
                foreach($result as $row):
                ?>
                <tr>
                    <td><?php echo $a;$a++; ?></td>
                    <td><?php echo $row['task_name']; ?></td>
                    <td><?php echo $row['task_details']; ?></td>

                    <td><?php echo date('d-m-y',strtotime($row['date_time']))." <b>TO</b> ".date('d-m-y',strtotime($row['submit_date_time'])); ?></td>
                    <td>
                    	<?php

            				$status = $row['status'];
            				if($status == "Submitted"){
            					echo "<span class='badge badge-warning'>Submitted</span>";
            				}
            				else if ($status == "Pending") {
            					echo "<span class='badge badge-info'>Pending</span>";
            				}
            				else if ($status == "Modification") {
            					echo "<span class='badge badge-danger'>Modification</span>";
            				}

            			 ?>
                    </td>
                    <td><a href="ViewTask.php?tid=<?php echo $row['t_id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>View</a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</div>


<?php require_once('footer.php'); ?> 
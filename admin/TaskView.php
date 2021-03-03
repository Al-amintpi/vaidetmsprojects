  
<?php require_once('header.php');

$t_id = $_GET['tid'];

if(isset($_POST['review_task'])){
    $t_id = $_GET['tid'];
    $review_task = $_POST["task_review"];
    $new_status = $_POST["new_status"];
    $review_date = date('Y-m-d');

    $stm = $pdo->prepare("UPDATE em_task SET status=?,review_task=?,review_date=? WHERE t_id=?");
    $stm->execute(array($new_status,$review_task,$review_date,$t_id));
    $success = "Review Successfully Completed";

}


$stm = $pdo->prepare("SELECT * FROM em_task WHERE t_id=?");
$stm->execute(array($t_id));
$result = $stm->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row){
    $user_id = $row['user_id'];
    $task_name = $row['task_name'];
    $task_details = $row['task_details'];
    $status = $row['status'];
    $work_details = $row['work_details'];
    $assign_date = $row['date_time'];
    $submit_date = $row['submit_date_time'];
    $task_review = $row['review_task'];

}




?>
<div class="row">
        <div class="col-6">
            <div class="card">
              <div class="card-header border-bottom">
                <h4>View Assign
                    <?php

                        if($status == "Submitted"){
                            echo "<span class='badge badge-warning'>Submitted</span>";
                        }
                        else if ($status == "Pending") {
                            echo "<span class='badge badge-info'>Pending</span>";
                        }
                        else if ($status == "Modification") {
                            echo "<span class='badge badge-danger'>Modification</span>";
                        }
                        else if ($status == "Completed") {
                            echo "<span class='badge badge-success'>Completed</span>";
                        }
                        else if ($status == "NotApproved") {
                            echo "<span class='badge badge-primary'>Not Approved</span>";
                        }
                     ?>
                </h4>
              </div>
              <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="task_name">Employee Name</label>
                        <h6><?php echo em_user($user_id,'first_name')." ".em_user($user_id,'last_name'); ?></h6>
                         
                    </div>
                     
                    <div class="form-group">
                        <label for="task_name">Task Name</label>
                        <h6><?php echo $task_name; ?></h6>
                         
                    </div>
                    <div class="alert alert-info">
                        <label for="task_details">Task Details</label>
                         <h6><?php echo $task_details; ?></h6>
                    </div>
                    <div class="form-group">
                        <label for="task_details">Deadline</label>
                         <p>Assign Date<?php echo date('Y-m-d',strtotime($assign_date)); ?>  Submitted Date<?php echo date('Y-m-d',strtotime($submit_date)); ?> </p>
                    </div>
                    <?php if($work_details !=null): ?>
                    <div class="alert alert-primary">
                        <label for="task_details">Submit works details</label>
                        <h6><?php echo $work_details;?></h6>
                     </div>
                    <?php endif; ?> 
                    <?php if($status !="Completed"): ?>
                    <div class="form-group">
                        <label for="task_review">Review Task</label>
                        <textarea type="text" name="task_review" id="task_review" class="summernote"><?php echo $task_review; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="new_status">Status</label>
                        <select name="new_status" id="new_status" class="custom-select">  
                            <option selected value="<?php echo $status; ?>"><?php echo $status; ?></option>
                            <option value="Modification">Modification</option>
                            <option value="Completed">Completed</option>
                            <option value="NotApproved">Not Approved</option>
                        </select>
                    </div>

                    <div class="form-group">  
                        <input type="submit" name="review_task" class="btn btn-success" value="Riview Submit">
                    </div>
                    <?php else: ?>
                        <div class="alert alert-success">
                            <label for="task_name">Review Task</label>
                            <h6><?php echo $task_review; ?></h6>
                        </div>
                    <?php endif; ?>
                </form>
              </div>
            </div>
          </div>
</div>         
<?php require_once('footer.php'); ?>            
 
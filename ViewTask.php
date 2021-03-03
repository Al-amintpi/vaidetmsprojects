<?php require_once('header.php');

$user_id = $_SESSION['em_user'][0]['u_id'];
$t_id = $_REQUEST['tid'];



if(isset($_POST['submit_work'])){
    $work = $_POST['work'];
    $status = "Submitted";
    $update_at = date('Y-m-d h:i:s');

    if (empty($work)) {
        $error = "Field is required";
    }else{
        $stm=$pdo->prepare("UPDATE em_task SET work_details=?,status=?,update_at=?,task_read=? WHERE user_id=? AND t_id=?");
        $stm->execute(array($work,$status,$update_at,0,$user_id,$t_id));
        $success = "Work submit success";
        $messages = "Create New Task";
        $messages.='
        <table>
            <tr>
                <td>Employee Name</td>
                <td>'.em_user($user_id,"first_name")." ".em_user($user_id,"last_name").'</td>
            </tr>
            <tr>
                <td>task details</td>
                <td>'.$work.'</td>
             </tr>  
             <tr>
                <td>Task Status</td>
                <td>'.$status.'</td>
            </tr> 
        </table>
        
        ';
        admin_Email($sub,$messages);

    }
}

$stm = $pdo->prepare("SELECT * FROM em_task WHERE user_id=? AND t_id=? ");
$stm->execute(array($user_id, $t_id));
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row){
    $task_name = $row['task_name'];
    $task_details = $row['task_details'];
    $date_time = $row['date_time'];
    $submit_date_time = $row['submit_date_time'];
    $status = $row['status'];
    $work_details = $row['work_details'];
    $review_task = $row['review_task'];
    $review_date = $row['review_date'];
}


 ?>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Name : <?php echo $task_name; ?></h6>
        </div>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <?php if(isset($success)): ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <div class="card-body">
            <table class="table">
                <tr>
                    <td>Task Name</td>
                    <td><?php echo $task_name; ?></td>
                </tr>
                <tr>
                    <td>Task Details</td>
                    <td><?php echo $task_details; ?></td>
                </tr>
                <tr>
                    <td>Deadline</td>
                    <td>
                    <?php 
                         echo date('d-m-y',strtotime($date_time))." <b>TO</b> ".date('d-m-y',strtotime($submit_date_time)); 
                     ?>
                         
                     </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php
                         
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
                            echo "<span class='badge badge-danger'>Completed</span>";
                        }
                        else if ($status == "NotApproved") {
                            echo "<span class='badge badge-primary'>NotApproved</span>";
                        }

                     ?></td>
                </tr>
            </table> 

            <?php if($status != "Completed") : ?>
                <?php if($status=="Modification" OR $status=="NotApproved"):?>
                    <div class="alert alert-danger">
                    <b>Review Date:</b><br>
                     <?php echo date('Y-m-d h:i A',strtotime($review_date)); ?><br>
                    <b>Review Details</b>
                     <?php echo $review_task; ?>

                </div>
                <?php endif; ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="work">Work :<small>If you need some share the link</small></label>
                    <textarea name="work" id="work" class="summernote">
                        <?php echo $work_details; ?>
                    </textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit_work" class="form-control btn btn-success" value="Submit-work">
                </div>
            </form> 
            <?php else: ?> 
                <div class="alert alert-success">
                    Your Work : <?php echo $work_details; ?>
                    
                </div>
                <div class="alert alert-secondary">
                    <b>Review Date:</b><br>
                     <?php echo date('Y-m-d h:i A',strtotime($review_date)); ?><br>
                    <b>Review Details</b>
                     <?php echo $review_task; ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
<?php require_once('footer.php'); ?> 
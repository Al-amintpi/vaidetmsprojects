<?php require_once('header.php');

$user_id = $_SESSION['em_user'][0]['u_id'];
$t_id = $_REQUEST['tid'];

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
}

if(isset($_POST['submit_work'])){
    $work = $_POST['work'];
    $status = "Submitted";
    $update_at = date('Y-m-d h:i:s');

    if (empty($work)) {
        $error = "Field is required";
    }else{
        $stm=$pdo->prepare("UPDATE em_task SET work_details=?,status=?,update_at=? WHERE user_id=? AND t_id=?");
        $stm->execute(array($work,$status,$update_at,$user_id,$t_id));
        $success = "Work submit success";
    }
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

                     ?></td>
                </tr>
            </table> 

            <?php if($work_details == null) : ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="work">Work :<small>If you need some share the link</small></label>
                    <textarea name="work" id="work" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit_work" class="form-control btn btn-success" value="Submit-work">
                </div>
            </form> 
            <?php else: ?> 
                <p>Your Work : <?php echo $work_details; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
<?php require_once('footer.php'); ?> 
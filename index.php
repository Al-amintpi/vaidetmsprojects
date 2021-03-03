<?php require_once('header.php'); ?>
<?php require_once('mobileverify.php');?>

<?php
    
    if(isset($_COOKIE['rememberUser'])){
        $user_id=$_COOKIE['rememberUser'];
        
    }
    else{
        $user_id = $_SESSION['em_user'][0]['u_id'];
    }

	 
	$c_year =date("Y");
	$c_month = date("m");
	$monthly_attendance = checkAttEm($c_year,$c_month,$user_id);

	$monthlyPracticeClass = monthlyPracticeClass($c_year,$c_month,$user_id);
	$monthlyPendingTask = monthlyPendingTask($c_year,$c_month,$user_id,"Pending");
	$c_monthly_complete_task = monthlyPendingTask($c_year,$c_month,$user_id,"Completed");

	// Yearly Attendance
	$yearlyAttcheck=yearlyAttcheck($c_year,$user_id);
	$yearlyPracticeClass=yearlyPracticeClass($c_year,$user_id);
	$yearlyPendingTask=yearlyPendingTask($c_year,$user_id,"Pending");
	$yearlyCompleteTask=yearlyPendingTask($c_year,$user_id,"Completed");

	// dateTodate Filter
	// $datetodatefilter = dateTodatePracticeClass('2020-01-01','2021-01-16','3');
	// echo $datetodatefilter;

 ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Monthly Report</h1>
     
</div>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Attendance</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $monthly_attendance;?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Practice Class</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $monthlyPracticeClass; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-laptop fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Tasks
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $monthlyPendingTask; ?></div>
                            </div>
                          
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
     
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Complete task Task</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $c_monthly_complete_task; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
</div>
 

<!-- Yearly Report -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Yearly Report</h1>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Attendance</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $yearlyAttcheck;?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Practice Class</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $yearlyPracticeClass; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-laptop fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Tasks
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $yearlyPendingTask; ?></div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
     
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Complete Task</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $yearlyCompleteTask; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
</div>
<!-- Content Row -->

<?php require_once('footer.php');?>
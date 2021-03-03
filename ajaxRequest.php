<?php 
require_once "config.php";
require_once "functions.php";

// Notification
if(isset($_POST['postType'])){
	$userid = $_POST['userId'];

	$count0 = $_POST['count0'];

	if($count0==0){
		$stm = $pdo->prepare("UPDATE em_task SET task_read=? WHERE user_id=?");
		$stm->execute(array(1,$userid));
	}

	else{
		$stm = $pdo->prepare("SELECT user_id,status,task_read FROM em_task WHERE user_id=? AND status=? AND task_read=?");
		$stm->execute(array($userid,"Pending",0));
		$notiTaskCount = $stm->rowCount();
	}
	

	$response = array(
		'notiTaskCount' => $notiTaskCount,
		'count0' => $count0

	);

	echo json_encode($response);
}


// Admin Notification
if(isset($_POST['Notification'])){
	$count0 = $_POST['count0'];

	if($count0==0){
		$stm = $pdo->prepare("UPDATE em_class SET class_read=? WHERE class_read=?");
		$stm->execute(array(1,0));

		$stm = $pdo->prepare("UPDATE em_task SET task_read=? WHERE status=?");
		$stm->execute(array(1,"Submitted"));

	}

	else{
		$stm=$pdo->prepare("SELECT user_id,class_name,class_read FROM em_class WHERE class_read=?");
		$stm->execute(array(0));
		$classCount = $stm->rowCount();

		 

		$stm = $pdo->prepare("SELECT status,task_read FROM em_task WHERE task_read=? AND status=?");
		$stm->execute(array(0,"Submitted"));
		$taskCount = $stm->rowCount();

		$notiCount = $classCount+$taskCount;

	}
	
	$response = array(
		'notiCount' => $notiCount,
		'count0' => $count0

	);

	echo json_encode($response);
}
 

// Read Notification
if(isset($_POST['tableName'])){
	$tableName = $_POST['tableName'];
	$DataId = $_POST['DataId'];

	if($tableName == "em_class"){
		$stm = $pdo->prepare("UPDATE em_class SET class_read=? WHERE c_id=?");
		$stm->execute(array(1,$DataId));
	}
	 
	if($tableName == "em_task"){
		$stm = $pdo->prepare("UPDATE em_task SET task_read=? WHERE status=? AND t_id=?");
		$stm->execute(array(1,"Submitted",$DataId));
	}
	
	$response = array(
		'table_name' => $tableName,
		'dataID' => $DataId
	);

	echo json_encode($response);
} 

?>
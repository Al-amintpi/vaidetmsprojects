<?php 
require_once("config.php");
function inputCount($col, $val){
    	global $pdo;
    	$countvalue = $pdo->prepare("SELECT $col FROM em_user WHERE $col=?");
    	$countvalue->execute(array($val));
    	$count = $countvalue->rowCount();
    	return $count;
    }


function em_user($id,$col){
	global $pdo;
	$stm = $pdo->prepare("SELECT $col FROM em_user WHERE u_id=?");
	$stm->execute(array($id));
	$result = $stm->fetchAll(PDO::FETCH_ASSOC);
	// var_dump($result);
	return $result[0]["$col"];
}

function em_user_count(){
	global $pdo;
	$stm = $pdo->prepare("SELECT * FROM em_user");
	$stm->execute(array());
	$count = $stm->rowCount();
   	return $count;
}

function ad_user($id,$col){
	global $pdo;
	$stm = $pdo->prepare("SELECT $col FROM em_admins WHERE ad_id=?");
	$stm->execute(array($id));
	$result = $stm->fetchAll(PDO::FETCH_ASSOC);
	// var_dump($result);
	return $result[0]["$col"];
} 

function em_att_submit($date,$user_id){
	global $pdo;
	$stm = $pdo->prepare("SELECT em_id,usertime FROM em_attendance WHERE DATE(usertime) = ? AND em_id=?");
	$stm->execute(array($date,$user_id));
	return $result = $stm->rowCount();
	// return $result[0]['user_time']; 
}
// echo em_att_submit('2020-12-17','15');


function Attendance_count($date){
	global $pdo;
	$stm = $pdo->prepare("SELECT * FROM em_attendance WHERE DATE(usertime) = ?");
	$stm->execute(array($date));
	return $result = $stm->rowCount();
	  
}


function checkATTinfo($user_id,$check_date,$col){
	global $pdo;
	$stm = $pdo->prepare("SELECT * FROM em_attendance WHERE em_id=? AND DATE(usertime) = ?");
	$stm->execute(array($user_id,$check_date));
	$result = $stm->fetchAll(PDO::FETCH_ASSOC);
	return $result[0]["$col"];
	 
}
 // echo checkATTinfo(15,'2020-12-17','attendance');
?>

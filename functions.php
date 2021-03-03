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


// Monthly Attendance 
function checkAttEm($year,$month,$user_id){
	global $pdo;
	$stm = $pdo->prepare("SELECT usertime,em_id FROM em_attendance WHERE YEAR(usertime)=? AND MONTH(usertime) = ? AND em_id=?");
	$stm->execute(array($year,$month,$user_id));
	return $result = $stm->rowCount();


}

// Monthly Practice Class
function monthlyPracticeClass($year,$month,$user_id){
	global $pdo;
	$stm = $pdo->prepare("SELECT date_time,user_id FROM em_class WHERE YEAR(date_time)=? AND MONTH(date_time) = ? AND user_id=?");
	$stm->execute(array($year,$month,$user_id));
	return $result = $stm->rowCount();


}

// Monthly Pending task 
function monthlyPendingTask($year,$month,$user_id,$status){
	global $pdo;
	$stm = $pdo->prepare("SELECT date_time,user_id,status FROM em_task WHERE YEAR(date_time)=? AND MONTH(date_time) = ? AND user_id=? AND status=?");
	$stm->execute(array($year,$month,$user_id,$status));
	return $result = $stm->rowCount();


}

// Yearly Attendance
function yearlyAttcheck($year,$user_id){
	global $pdo;
	$stm = $pdo->prepare("SELECT usertime,em_id FROM em_attendance WHERE YEAR(usertime)=? AND em_id=?");
	$stm->execute(array($year,$user_id));
	return $result = $stm->rowCount();
}

//Yearly Practice Class
function yearlyPracticeClass($year,$user_id){
	global $pdo;
	$stm = $pdo->prepare("SELECT date_time,user_id FROM em_class WHERE YEAR(date_time)=? AND user_id=?");
	$stm->execute(array($year,$user_id));
	return $result = $stm->rowCount();
}


// Yearly Pending task 
function yearlyPendingTask($year,$user_id,$status){
	global $pdo;
	$stm = $pdo->prepare("SELECT date_time,user_id,status FROM em_task WHERE YEAR(date_time)=? AND user_id=? AND status=?");
	$stm->execute(array($year,$user_id,$status));
	return $result = $stm->rowCount();
}

// // dateTodatefilter
// function dateTodatePracticeClass($start_date,$end_date,$user_id){
// 	global $pdo;
// 	$stm = $pdo->prepare("SELECT date_time,user_id FROM em_class WHERE date_time BETWEEN ? AND ? AND user_id=?");
// 	$stm->execute(array($start_date,$end_date,$user_id));
// 	return $result = $stm->rowCount();
// }

function admin_Email($sub,$messages){
    $to = "alamincmt7418@gmail.com";
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    $mail = mail($to,$sub,$messages,$headers);
    if($mail==true){
        return true;
    }
    else{
        return false;
    }
}

// Admin today Practice class
function todayPracticeClass($date){
	global $pdo;
	$stm = $pdo->prepare("SELECT date_time FROM em_class WHERE DATE(date_time)=?");
	$stm->execute(array($date));
	return $result = $stm->rowCount();
}

// Admin total Pending task
function TotalTask($status){
	global $pdo;
	$stm = $pdo->prepare("SELECT status FROM em_task WHERE status=?");
	$stm->execute(array($status));
	return $result = $stm->rowCount();
}
?>

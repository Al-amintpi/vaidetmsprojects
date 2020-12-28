<?php require_once('header.php'); ?>
<h1 class="h3 mb-4 text-gray-800">Attendance</h1>

<?php

$user_id = $_SESSION['em_user'][0]['u_id'];

if(isset($_POST['submit_attendance'])){
	$user_id = $_SESSION['em_user'][0]['u_id'];
	$ip_address = $_SERVER['SERVER_ADDR'];
	$devices_details = $_SERVER['HTTP_USER_AGENT'];
	$attendance = $_POST['attendance'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$systemtime = date("Y:m:d H:i:s");
	$att_datetime = $_POST['att_datetime'];
	// covert database datetime
	$date = $att_datetime;
	$newdate = date('Y-m-d H:i:s', strtotime($date));

	$today = date('Y:m:d');
	$today_attendance = em_att_submit($today,$user_id);
		 
	if(empty($att_datetime)){
		$error = "Date Time is required";
	}
	else if($today_attendance == 1){
		$error = "Already submitted your attendance";
	}
	else{
		$stm = $pdo->prepare("INSERT INTO em_attendance(
			em_id,attendance,usertime,systemtime,latitude,longitude,ip_address,devices_details
		) VALUES(?,?,?,?,?,?,?,?)");
		$stm->execute(array($user_id,$attendance,$att_datetime,$systemtime,$latitude,$longitude,$ip_address,$devices_details));
		$success = "Attendance created success";
	}
}

 ?>

<div class="row">
	<div class="col-md-6">
		<div class="card shadow">
		
		<form action="" method="POST">
			<?php if(isset($error)): ?>
				<div class="alert alert-danger">
					<?php echo $error ?>
				</div>
			<?php endif; ?>
			<?php if(isset($success)): ?>
				<div class="alert alert-success">
					<?php echo $success ?>
				</div>
			<?php endif; ?>
				<div class="alert alert-danger" id="locationerror">
					
				</div>

		 	

			<div class="form-group">
				<label for="attendance">
					<input class="custom-checkbox" value="1" type="checkbox" name="attendance" id="attendance" checked>
				</label>
			</div>
			<div class="form-group">
				<label for="att_datetime"><b>date-time</b></label>
				<input type="text" class="form-control" name="att_datetime" id="att_datetime" name="" placeholder="select your In Time">
			</div>

			<input type="hidden" name="latitude" id="latitude">
			<input type="hidden" name="longitude" id="longitude">
			<div class="form-group">
				<input type="submit" name="submit_attendance" class="btn btn-success" value="submit_attendance" id="submit_attendance" disabled="">
			</div>
		</form>
		</div>
	</div>	
</div>

<?php require_once('footer.php');?>
<script type="text/javascript">
	function getlocation(){
		$('#locationerror').hide();
		navigator.geolocation.getCurrentPosition(function(position){
			var lati = position.coords.latitude;
			var log = position.coords.longitude
			$("#latitude").val(lati);
			$("#longitude").val(log);
			$('#submit_attendance').attr('disabled', false);
			 
		},
		function showError(error){
			$('#locationerror').show();
			$('#submit_attendance').attr('disabled', true);
			if(error.PERMISSION_DENIED){
				$('#locationerror').text("User denied the request for Geolocation.");
			}
			else if(error.POSITION_UNAVAILABLE){
				$('#locationerror').text("Location information is unavailable.");
			}

			else if(error.TIMEOUT){
				$('#locationerror').text("The request to get user location timed out.");
			}

			else if(error.UNKNOWN_ERROR){
				$('#locationerror').text("An unknown error occurred.");
			}
		}

		);
	};	
	getlocation();
</script>
<?php 

$u_id = $_SESSION['em_user'][0]['u_id'];
$mobile_verify_status = em_user($u_id,"mobile_verify");

if(isset($_POST['mobile_verify_code'])){

	$user_mobile_number = em_user($u_id,'mobile');
	$verification_code = rand(1000,9999);
	echo "Your Verifycode".$verification_code;
	// $token = "9f4aac4cd7ca860f697e360fd0d53696";
	
	// 	$url = "https://freebulksmsonline.com/api/v1/index.php";

	// 			$postfields = array(
	// 				'token' => $token,
	// 				'number' => $user_mobile_number,
	// 				'message' =>  $verification_code,
	// 				'media' => "",
                                        
	// 			);

	// 			if (!$curld = curl_init()) {
	// 				exit;
	// 			}

	// 			curl_setopt($curld, CURLOPT_POST, true);
	// 			curl_setopt($curld, CURLOPT_POSTFIELDS, $postfields);
	// 			curl_setopt($curld, CURLOPT_URL,$url);
	// 			curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);

	// 			$curl_output = curl_exec($curld);
				
	// 			$response = json_decode($curl_output);

				
				
				
				
	// 			// if ($response->success == "true") { 
				
	// 			//Do something when the response is successful
				
 //                                 //} 
	// 			//else {
	// 			//Do something when the response fails
	// 			//}

	// 		}
	// try{
 //        $soapClient = new SoapClient("https://freebulksmsonline.com/api/v1/index.php");
 //        $paramArray = array(
 //        'userName'=> "alamin",
 //        'userPassword' => "alamin@#$%765trfedswa",
 //        'mobileNumber' => $user_mobile_number,
 //        'smsText' => "Your Verification code".$verification_code,
 //        'type' => "TEXT",
 //        'maskName' => "",
 //        'campaignName' =>'',
 //        );
 //        $value = $soapClient->__call("OneToOne", array($paramArray));
 //        	// echo $value->OneToOneResult; 
 //        } catch (Exception $e) {
 //         // echo $e->getMessage;
	// 	} 
    
    $mobileSuccess = "Verification code send";
    $stm = $pdo->prepare("UPDATE em_user SET mobile_verify_code=? WHERE u_id=?");
	$stm->execute(array($verification_code,$u_id));		
}

// submit code

if(isset($_POST['submit_code'])){
	$user_code = $_POST["input_code_number"];
	$db_code = em_user($u_id,"mobile_verify_code");
	if(empty($user_code)){
		$error = "Input code required";
	}
	else{
		if($user_code == $db_code){
			$stm = $pdo->prepare("UPDATE em_user SET mobile_verify=? WHERE u_id=?");
			$stm->execute(array(1,$u_id));
			$success = "Mobile verify success";
		}
		else{

		}
	}
}
?>

 <?php if(isset($success)): ?>
	<div class="alert alert-success">
		<?php echo $success; ?>
	</div>
<?php endif; ?>

<?php if(isset($error)): ?>
	<div class="alert alert-danger">
		<?php echo $error; ?>
	</div>
<?php endif; ?>	

<div class="row">
	<div class="col-md-6">
		<?php if($mobile_verify_status == 0): ?>
		<div class="verification-area">
			<?php if(!isset($mobileSuccess)): ?>
			<div class="alert alert-danger">
				<div class="form-group">
					Please verify your mobile number
					<form method="POST" action="">
						<input type="submit" name="mobile_verify_code" value="Send Code" class="btn btn-success">
					</form>
				 </div>
			</div>	
			<?php else: ?>
			<div class="alert alert-danger">
				<div class="form-group">
					
						Please verify code submit
					<form method="POST" action="">
						<div class="form-group">
							<input type="text" name="input_code_number" class="form-control">
						</div>
						<div class="form-group">
							<input type="submit" name="submit_code" value="Code Send" class="btn btn-success" placeholder="Plz Type your code">
					   </div>
					</form>	
				<?php endif; ?>
				</div>
			</div>
		</div>
		 
	<?php endif; ?>
	</div>
</div>
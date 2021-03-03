<?php require_once('header.php');

if(isset($_COOKIE['rememberUser'])){
        $u_id=$_COOKIE['rememberUser'];
        
}
else{
    $u_id = $_SESSION['em_user'][0]['u_id'];
}

$stm=$pdo->prepare("SELECT password FROM em_user WHERE u_id=?");
$stm->execute(array($u_id));
$user_data = $stm->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['change_password'])){
	$current_password = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	$confirm_new_password = $_POST['confirm_new_password'];

	if(empty($current_password)){
		$error = "Current password required";
	}
	else if(empty($new_password)){
		$error = "New password required";
	}
	else if(empty($confirm_new_password)){
		$error = "Confirm password required";
	}
	else if($new_password != $confirm_new_password){
		$error = "New password and Confirm new password do not match";
	}
	else{

		$user_Password = SHA1($current_password);
		$db_Password = $user_data[0]['password'];
		$new_Password = SHA1($new_password);
		if($db_Password == $user_Password){
			$stm = $pdo->prepare("UPDATE em_user SET password=? WHERE u_id=?");
			$stm->execute(array($new_Password,$u_id));
			$success = "Password change successs";

		}else{
			$error = "Database Password and Current password do not match";
		}
	}

}



?>

<h1 class="h3 mb-4 text-gray-800">Change password</h1>
<div class="row">
	<div class="col-md-6">
		<form class="user" method="POST" action="">		

			<?php if(isset($error)): ?>
				<div class="alert alert-danger">
					<?php echo $error;?>
				</div>
			<?php endif; ?>	

			<?php if(isset($success)): ?>
				<div class="alert alert-success">
					<?php echo $success;?>
				</div>
				<script type="text/javascript">
					setTimeout(function(){
						window.location="logout.php";
					},3000);
				</script>
			<?php endif; ?>	

			<div class="form-group">
				<label for="current_password">Current Password</label>
	            <input type="password" name="current_password" id="current_password" class="form-control">
	        </div>

	        <div class="form-group">
				<label for="new_password">New Password</label>
	            <input type="password" name="new_password" id="new_password" class="form-control">
	        </div>

	        <div class="form-group">
				<label for="confirm_new_password">New Password</label>
	            <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control">
	        </div>

	        <div class="from-group">
	        	<input type="submit" name="change_password" class="btn btn-success" value="Update profile">
	        </div>
	    </form>    
	</div>
</div>

<?php require_once('footer.php');?>
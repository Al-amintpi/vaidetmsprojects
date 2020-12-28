<?php

session_start();
require_once('config.php');
require_once('functions.php');

 
if(!isset($_SESSION['fp_password2'])){
	header("location:forget_password_code.php");
}

$u_id = $_SESSION['fp_password2'][0]['u_id'];
echo em_user($u_id,'fp_verify_code');

if(isset($_POST['fp_submit'])){
	$new_password = $_POST['new_password'];
	$c_new_password = $_POST['c_new_password'];

	if(empty($new_password)){
		$error = "New password required";
	}
	else if(empty($c_new_password)){
		$error = "C_New_Password required";
	}
	else if($new_password != $c_new_password){
		$error = "New Password and C_new_password do not match";
	}else{
		$move_new_password = SHA1($new_password);
		$stm = $pdo->prepare("UPDATE em_user SET password=? WHERE u_id=?");
		$stm->execute(array($move_new_password, $u_id));
		header("location:logout.php");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Foget Password</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
<style type="text/css">
.col-md-4.offset-md-4.mt-5 {
	box-shadow: 1px 1px 13px #00000075;
}
</style>
</head>

<body>
<div class="row">
	 
	<div class="col-md-4 offset-md-4 mt-5">
		<h1 class="h3 mb-4 text-gray-800">Password Reset</h1>
		<form class="user" method="POST" action="">		
			<?php if(isset($error)): ?>
				<div class="alert alert-danger">
					<?php echo $error; ?>
				</div>
			<?php endif; ?>	
			<div class="form-group">
				<label for="new_password">New Password</label>
	            <input type="password" name="new_password" id="new_password" class="form-control">
	        </div>
	        <div class="form-group">
				<label for="c_new_password">Confirm New Password</label>
	            <input type="password" name="c_new_password" id="c_new_password" class="form-control">
	        </div>
	        <div class="form-group">
	        	<input type="submit" name="fp_submit" id="" class="btn btn-success" value="Forget Password">
	        </div>
	    </form>
	</div>

</div>	

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>
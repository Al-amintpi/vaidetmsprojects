<?php

require_once('config.php');
require_once('functions.php');

session_start();
if(!isset($_SESSION["f_password"])){
	header("location:forget_email.php");
}

$u_id = $_SESSION['f_password'][0]['u_id'];
$db_fp_code = em_user($u_id,'fp_verify_code');
echo $db_fp_code;

if(isset($_POST['fp_code_submit'])){
	$user_code = $_POST['fp_code'];
	if(empty($user_code)){
		$error = "User code is required";
	}
	else if($db_fp_code != $user_code){
		$error = "Verify Code Invalid";
	}
	else{
		
		$_SESSION['fp_password2'] = $_SESSION["f_password"] ;
		header("location:forget_password.php");
		$success="Verify Code is correct";

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
		<h1 class="h3 mb-4 text-gray-800">Submit Code</h1>
		<form class="user" method="POST" action="">		
			<?php if(isset($error)): ?>
				<div class="alert alert-danger">
					<?php echo $error; ?>
				</div>
			<?php endif; ?>	
			<div class="form-group">
				<label for="fp_code">Verify Code</label>
	            <input type="text" name="fp_code" id="fp_code" class="form-control">
	        </div>
	        <div class="form-group">
	        	<input type="submit" name="fp_code_submit" id="" class="btn btn-success" value="Submit Code">
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
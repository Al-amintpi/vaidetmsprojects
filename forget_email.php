<?php

require_once('config.php');
session_start();

if(isset($_POST['email_submit'])){
	$email = $_POST['forget_email'];

	$stm = $pdo->prepare("SELECT u_id,email FROM em_user WHERE email=?");
	$stm->execute(array($email));
	$user_data = $stm->fetchAll(PDO::FETCH_ASSOC);
	$emailCount = $stm->rowCount();
	 
	if(empty($email)){
		$error = "Email is required";
	}
	else if($emailCount !=1){
		$error = "Email is Wrong";
	}
	else{
		$fp_code = rand(1000,9999);
		$stm = $pdo->prepare("UPDATE em_user SET fp_verify_code=? WHERE email=?");
		$stm->execute(array($fp_code,$email));
		$_SESSION['f_password'] = $user_data;
		echo "success";
		header("location:forget_password_code.php");
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

    <title>ETMS - DASHBOARD</title>

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
		<h1 class="h3 mb-4 text-gray-800">Forget Password email</h1>
		<form class="user" method="POST" action="">	
			<?php if(isset($error)): ?>
				<div class="alert alert-danger">
					<?php echo $error;?>
				</div>
			<?php endif; ?>	
			<div class="form-group">
				<label for="forget_email">Email</label>
	            <input type="email" name="forget_email" id="forget_email" class="form-control">
	        </div>
	        <div class="form-group">
	        	<input type="submit" name="email_submit" id="" class="btn btn-success" value="Submit email">
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
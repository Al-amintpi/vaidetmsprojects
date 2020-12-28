 <?php require_once('header.php'); ?>
<h1 class="h3 mb-4 text-gray-800">Practice..</h1>

<?php

if(isset($_POST['submit_class'])){
	
	$user_id = $_SESSION['em_user'][0]['u_id'];
	$class_name = $_POST['class_name'];
	$class_description = $_POST['class_description'];
	$today = date('Y:m:d H:i:s');
	 
		 
	if(empty($class_name)){
		$error = "Class Name is required";
	}
	else if(empty($class_description)){
		$error = "Class Description is required";
	}
	else{
		$stm = $pdo->prepare("INSERT INTO em_class(user_id,class_name,class_description,date_time)VALUES(?,?,?,?)");
		$stm->execute(array($user_id,$class_name,$class_description,$today));
		$success = "Class Submitted Successfull";
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
			 
			<div class="form-group">
				<label for="class_name">New Class</label>
				<input type="text" class="form-control" name="class_name" id="class_name">
			</div>

			<div class="form-group">
				<label for="class_description">Class Description</label>
				<textarea class="form-control" name="class_description" id="class_description"></textarea>
			</div>
			 
			<div class="form-group">
				<input type="submit" name="submit_class" class="btn btn-success" value="submit_class" id="submit_class">
			</div>
		</form>
		</div> 
	</div> 	
</div>

<?php require_once('footer.php');?>
 
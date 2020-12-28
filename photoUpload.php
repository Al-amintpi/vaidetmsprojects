<?php
require_once('header.php'); 
require_once('config.php');


$u_id = $_SESSION['em_user'][0]['u_id'];


if (isset($_POST["upload_profile"])){

	$photo = $_FILES["profile_photo"];
	$p_name = $_FILES["profile_photo"]["name"];
	$p_tmp_name = $_FILES["profile_photo"]["tmp_name"];
	$p_size = $_FILES["profile_photo"]["size"];

	$extension = pathinfo($p_name, PATHINFO_EXTENSION);

	if(empty($p_name)){
		$error = "Upload field required";
	}
	else if ($extension !='png' and $extension !='PNG' AND $extension !='JPG' AND $extension !='jpg' and $extension !='jpeg' and $extension !='jpeg' and $extension !='gif' and $extension !='GIF') {
		$error = "Please Right file type";
	}

	else{
		$new_name = $u_id.".".$extension;
		$upload = move_uploaded_file($p_tmp_name, 'profilephotos/'.$new_name);
		$stm = $pdo->prepare("UPDATE em_user SET photo=? WHERE u_id=?");
		$stm->execute(array($new_name,$u_id));
			if($upload == true){
				$success="Profile Photo update successfully";
			}else{
				$error = "Uploaded Failed";
			}

	}

}

?>

<div class="row">
	<div class="col-md-6">
		<form class="user" method="POST" action="" enctype="multipart/form-data">

			<?php if(isset($error)): ?>
				<div class="alert alert-danger">
					<?php echo $error;?>
				</div>
			<?php endif; ?>	

			<?php if(isset($success)): ?>
				<div class="alert alert-success">
					<?php echo $success; ?>
				</div>
			<?php endif; ?>	

			<div class="form-group">
				<label for="profile_photo">Profile Photo Upload</label>
	            <input type="file" name="profile_photo" id="profile_photo" class="form-control">
	        </div>
	        <div class="form-group">
	        	<input type="submit" name="upload_profile" id="upload_profile" value="Upload profile">
	        </div>
	    </form>
	</div>
</div>	        

<?php require_once('footer.php'); ?>
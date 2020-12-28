<?php 

require_once('header.php');



// JUST GET 
$u_id = $_SESSION['em_user'][0]['u_id'];


// JUST POST

if (isset($_POST['update_profile'])) {

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$birthday = $_POST['birthday'];
	$blood_group = $_POST['blood_group'];
	$fathers_name = $_POST['fathers_name'];
	$mothers_name = $_POST['mothers_name'];
	$f_m_mobile = $_POST['f_m_mobile'];
	$education = $_POST['edu'];
	$address = $_POST['address'];

	if(empty($first_name)){
		$error = "First Name required";
	}
	else if(empty($last_name)){
		$error = "Last Name required";
	}
	else if (empty($birthday)) {
             $error = "Birthday is required";
        }
	else if (empty($blood_group)) {
        $error = "Blood group is required";
    }
    else if (empty($fathers_name)) {
        $error = "Father name is required";
    }
    else if (empty($mothers_name)) {
        $error = "Mother name is required";
    }
    // f_m_mobile_number
    else if (empty($f_m_mobile)) {
         $error = "F_M_mobile name is required";
    }
    else if(strlen($f_m_mobile) !=11){
        $error = "F_OR_M_Mobile Number must be 11 digits";
    }
    else if(!is_numeric($f_m_mobile)) {
         $error = "F_OR_M_mobile type invalid";
    }
	 
	else{

		$stm = $pdo->prepare("UPDATE em_user SET first_name=?,last_name=?,birthday=?, blood_group=?,father_name=?,mother_name=?,f_or_m_mobile=?,edu=?,address=? WHERE u_id=?");
		$stm->execute(array($first_name,$last_name,$birthday,$blood_group,$mothers_name,$fathers_name,$f_m_mobile,$education,$address,$u_id));
		$success = "Update profile success";

	}

}

?>
 
<h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>

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
			<?php endif; ?>	

			<div class="form-group">
				<label for="first_name">First Name</label>
	            <input type="text" name="first_name" id="" class="form-control" value="<?php echo em_user($u_id,'first_name');?>">
	        </div>

	        <div class="form-group">
				<label for="last_name">Last Name</label>
	            <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo em_user($u_id,'last_name');?>">
	        </div>

	        <div class="form-group">
				<label for="birthday">Birthday</label>
	            <input type="date" name="birthday" id="birthday" class="form-control"value="<?php echo em_user($u_id,'birthday');?>">
	        </div>

	        <div class="form-group">
				<select name="blood_group" id="blood_group" class="form-control">
                     <option value="<?php echo em_user($u_id,'blood_group');?>" selected><?php echo em_user($u_id,'blood_group');?> </option>
                     <option value="A-">A-</option>
                     <option value="B+">B+</option>
                     <option value="B-">B-</option>
                     <option value="O+">O+</option>
                     <option value="O-">O-</option>
                     <option value="AB+">AB+</option>
                     <option value="AB-">AB-</option>
                </select>
	        </div>

	        <div class="form-group">
				<label for="fathers_name">Father Name</label>
	            <input type="text" name="fathers_name" id="fathers_name" class="form-control" value="<?php echo em_user($u_id,'father_name');?>">
	        </div>
	            
	        <div class="form-group">
				<label for="mothers_name">Mother Name</label>
	            <input type="text" name="mothers_name" id="mothers_name" class="form-control" value="<?php echo em_user($u_id,'mother_name');?>">
	        </div>

	        <div class="form-group">
				<label for="f_m_mobile">F_OR_M_Mobile Name</label>
	            <input type="text" name="f_m_mobile" id="f_m_mobile" class="form-control" value="<?php echo em_user($u_id,'f_or_m_mobile');?>">
	       	</div>

	        <div class="form-group">
				<label for="edu">Education</label>
	            <input type="text" name="edu" id="edu" class="form-control" value="<?php echo em_user($u_id,'edu');?>">
	        </div>

	        <div class="form-group">
				<label for="address">Address</label>
	            <input type="text" name="address" id="address" class="form-control" value="<?php echo em_user($u_id,'address');?>">
	        </div>

	        <div class="from-group">
	        	<input type="submit" name="update_profile" class="btn btn-success" value="Update profile">
	        </div>
	    </form>    
	</div>
</div>

     



<?php require_once('footer.php'); ?>
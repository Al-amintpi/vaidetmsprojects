<?php require_once('header.php'); ?>
<?php
	$u_id = $_SESSION['em_user'][0]['u_id'];
	$mobile_verify_status = em_user($u_id, "mobile_verify");

?>

<h1 class="h3 mb-4 text-gray-800">Profile <a href="profileUpdate.php?u_id=<?php echo $u_id ?>" class="btn btn-info"> Update button </a></h1>


<div class="row">
			<div class="col-md-6">
				<table class="table table-bordered">
					<tr>
						<th>First-Name</th>
						<td><?php echo em_user($u_id,'first_name'); ?></td>
					</tr>
					<tr>
						<th>Last-Name</th>
						<td><?php echo em_user($u_id,'last_name'); ?></td>
					</tr>
					<tr>
						<th>Email</th>
						<td><?php echo em_user($u_id,'email'); ?></td>
					</tr>
					<tr>
						<th>Mobile-number</th>
						<td><?php echo em_user($u_id,'mobile'); ?> 

						<?php if($mobile_verify_status == 1){

							echo "<i title='mobile-verified' style='color:green;' class='fa fa-check'></i>";
						
						}?>
					</td>
					</tr>
					<tr>
						<th>BirthDay</th>
						<td><?php echo em_user($u_id,'birthday');; ?></td>
					</tr>
					<tr>
						<th>Blood Group</th>
						<td><?php echo em_user($u_id,'blood_group'); ?></td>
					</tr>
					<tr>
						<th>Father-Name</th>
						<td><?php echo em_user($u_id,'father_name'); ?></td>
					</tr>
					<tr>
						<th>Mother-Name</th>
						<td><?php echo em_user($u_id,'mother_name'); ?></td>
					</tr>
					<tr>
						<th>Father or Mother Mobile Number</th>
						<td><?php echo em_user($u_id,'f_or_m_mobile'); ?></td>
					</tr>
					<tr>
						<th>Education</th>
						<td><?php echo em_user($u_id,'edu'); ?></td>
					</tr>
					<tr>
						<th>Address</th>
						<td><?php echo em_user($u_id,'address'); ?></td>
					</tr>
					 
				</table>
			</div>	
</div>

<?php require_once('footer.php');
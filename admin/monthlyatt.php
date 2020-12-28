<?php require_once('header.php');?>
  
 

  

 <div class="card shadow mb-4">
	<div class="card-header py-3">
		<?php if(isset($_POST['filter_date'])): ?>
			<h6 class="m-0 font-weight-bold text-primary">Monthly Attendance ~ <span>
				<?php echo "1-".$_POST['month_name']."-".$_POST['year_name']; ?>
				 To 
				 <?php
				  $st_date = $_POST['year_name']."-".$_POST['month_name'];
					echo date('t-M-Y', strtotime($st_date)); ?></span>
			</h6>
			<?php else: ?>
	    	<h6 class="m-0 font-weight-bold text-primary">Monthly Attendance ~ <span><?php echo "1".date('-M-Y'); ?> To <?php echo date('d-M-Y'); ?></span></h6>
	<?php endif; ?>

	</div>

	<div class="filter_atts">
		<form action="" method="POST">
			<div class="form-group">
				<label for="month_name">Month</label>
				<select name="month_name" class="custom-select" id="month_name">
					<?php if(isset($_POST['month_name'])): ?>
						<option value="<?php echo $_POST['month_name']; ?>">
							<?php
								$st_date = $_POST['year_name']."-".$_POST['month_name'];
								echo date('F', strtotime($st_date));
							 ?>
						</option>
					<?php endif ?>	
					<option value="01">January</option>
					<option value="02">February</option>
					<option value="03">March</option>
					<option value="04">April</option>
					<option value="05">May</option>
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>
					<option value="09">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
			</div>
			<div class="form-group">
				<label for="year_name">Year</label>
				<select name="year_name" class="custom-select" id="year_name">
					<?php if(isset($_POST['year_name'])): ?>
						<option value="<?php echo $_POST['year_name']; ?>"><?php echo $_POST['year_name']; ?></option>
					<?php endif; ?>
					<?php 

					$start_y = 2018;
					$end_y = date('Y');
					for($i=$start_y; $i <= $end_y; $i++) :?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php endfor ?>
				</select>
			</div>
			<div class="form-group">
				<label></label>
				<input type="submit" class="btn btn-info form-control" name="filter_date" value="Filter">
			</div>
		</form>
	</div>

	<div class="card-body">
	    <div class="table-responsive">
	        <table class="table table-bordered" width="100%" cellspacing="0">
	            <thead>
	                <tr>
	                    <th>#</th>
	                    <th>Present</th>
	                    <th>Absent</th>
	                    <th>Date</th>
	                    <th>Action</th>
	                    
	                </tr>
	            </thead>


	             <?php if(isset($_POST['filter_date'])) : ?>
		             <tbody>
		            <?php
		                $start_date = 1;
		                $month = $_POST['month_name'];
		                $year = $_POST['year_name'];
		                $getDate = ($year."-".$month);
		                $enddate = date('t',strtotime($getDate));
		                 
		                for($i=$start_date; $i<=$enddate; $i++){
		                	 
		                	;?>
		                	<tr>
			                    <td><?php echo $i; ?></td>
			                    <td>
			                    	<?php 

			                    		$loop_date = $getDate."-".$i;
			                    		// echo $loop_date;
			                    		$present_att = Attendance_count($loop_date);
			                    		echo ($present_att);

			                    	 ?>
			                    </td>
			                    <td>
			                    	<?php 

			                    		$total_user = em_user_count();
			                    		$absent = $total_user-$present_att;
			                    		echo $absent;

			                    	?>
			                    </td>
			                    <td><?php
			                     $date = $getDate."-".$i;
			                     echo date('y-M-Y', strtotime($date));
			                     ?></td>
			                    <td><a href="singleDate.php?date=<?php echo $loop_date; ?>" class="btn btn-success"><i class="fa fa-eye"></i>View</a></td> 
		                	</tr> 
		                <?php } ?>
		            </tbody>
	             <?php else: ?>

	            <tbody>
	            <?php
	                $start_date = 1;
	                $current_date = date('d');
	                for($i=$start_date; $i<=$current_date; $i++){
	                	 
	                	;?>
	                	<tr>
		                    <td><?php echo $i; ?></td>
		                    <td>
		                    	<?php 

		                    		$loop_date = date('Y-m-').$i;
		                    		// echo $loop_date;
		                    		$present_att = Attendance_count($loop_date);
		                    		echo ($present_att);

		                    	 ?>
		                    </td>
		                    <td>
		                    	<?php 

		                    		$total_user = em_user_count();
		                    		$absent = $total_user-$present_att;
		                    		echo $absent;

		                    	?>
		                    </td>
		                    <td><?php echo $i.date('-M-y');?></td>
		                    <td><a href="singleDate.php?date=<?php echo $loop_date; ?>" class="btn btn-success"><i class="fa fa-eye"></i>View</a></td> 
	                	</tr> 
	                <?php } ?>
	            </tbody>

	        <?php endif; ?>

	        </table>
	    </div>
	</div>
</div>


           
<?php require_once('footer.php'); ?>         
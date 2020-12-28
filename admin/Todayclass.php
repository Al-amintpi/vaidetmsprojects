  
<?php require_once('header.php');


?>
   <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Date <?php echo date('d-M-Y'); ?></h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Class Name</th>
                            <th>Class Description</th>
                            <th>Time</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        	<?php
                            $today = date('Y-m-d');
                        		$stm = $pdo->prepare("SELECT * FROM em_class WHERE DATE(date_time) =? ");
                        		$stm->execute(array($today));
                        		$result = $stm->fetchAll(PDO::FETCH_ASSOC);
                        		$a = 1;
                        		 
                        		foreach($result as $row):

                        	 ?>
                          <tr>
                            <td><?php echo $a;$a++; ?></td>
                            <td><?php echo $row['class_name']; ?></td>
                            <td><?php echo $row['class_description']; ?></td>
                            <td><?php
                              echo date('h:i A', strtotime($row['date_time']));
                             ?></td>
                             <td></td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>         
<?php require_once('footer.php'); ?>            
 
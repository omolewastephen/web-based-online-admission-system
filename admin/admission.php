<?php require_once ("../includes/session.php");?>
<?php confirm_logged_in(); ?>
<?php require ("header_admin.php");?>
<?php
	$sum = 0;
	$query = "SELECT * FROM students";
	$result = mysql_query($query);
	// while ($students = mysql_fetch_array($result)) {
	// 	$sum = $sum + $students['fee'];
	// }

	$sums = 0;
	$queryz = "SELECT * FROM students WHERE admission_status = 1";
	$resultz = mysql_query($queryz);
	// while ($studentz = mysql_fetch_array($resultz)) {
	// 	$sums = $sums + $studentz['fee'];
	// }
?>
 
	  <div id="content">
        <div class="content_item">
		  <h1>Welcome <?php echo $_SESSION['username'];?></h1>
		  <form action="accept.php" method="post">
	      <div class="content_container">
		  <h3>Admission Details</h3>
		  <p>Registered Students : <?php echo mysql_num_rows($result);?></p>
		  <p>Admitted Students : <?php echo mysql_num_rows($resultz);?></p>
		 
            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal">Accept</button>
         
		    <div class="table-responsive">
		      <table id="student" width="100%" class="table table-hover table-striped">
					<thead>
					<tr>
						<th>SN</th>
						<th>Full Name</th>
						<th>Jamb</th>
						<th>Exam</th>
						<th>Option</th>
					</tr>
					</thead>
					<tbody>
		      	<?php
		      		$query = "SELECT * 
		   				FROM students";
	     			$student_set = mysql_query($query, $connection);
		      		confirm_query($student_set);

		      		while ($student = mysql_fetch_array($student_set)) {
                      $lc = getlocal($student['local']);

					  $lcname = $lc['local_name'];

					  $sn = getstate($student['state_id']);

					  $sname = $sn['name'];
		      		 ?>
		      			<tr>
		      				<td><?php echo $student['id']; ?></td>
		      				<td><?php echo $student['surname']." ".$student['name']; ?></td>
		      				<td><?php echo $student['jambreg']; ?></td>
		      				<td><?php echo ucwords($student['exam']); ?></td>
		      				<td>
		      					<?php 
		      					  $sid = $student['id']; 
		      					  echo ($student['admission_status'] == 1) ? '<b>offered</b>' : '<input type="checkbox" name="selector[]" value="$sid">';
		      					  ?>
		      					
		      				</td>
		      			</tr>			
		   		<?php
		   	      }
		   		?>
		   	    </tbody>
		      </table>
	       </div>
		  </div><!--close content_container-->
		  <?php include 'modal.php'; ?>
        </form>
		</div><!--close content_item-->
      </div><!--close content-->   
	</div><!--close site_content--> 

<?php require ("footer_admin.php");?>


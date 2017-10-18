<?php require_once ("../includes/session.php");?>
<?php confirm_logged_in(); ?>
<?php require_once ("../includes/connection.php");?>
<?php require_once ("../includes/functions.php");?>
<?php require ("header_admin.php");?>
	  <div id="content">
        <div class="content_item">
		  <h1>Welcome To Registered Students List</h1>
		  <div class="table-responsive">
		      <table id="student" class="table table-hover table-striped">
					<thead>
					<tr>
						<th>SN</th>
						<th>Full Name</th>
						<th>Jamb</th>
						<th>Exam</th>
						<th>Phone</th>
						<th>State</th>
						<th>Local Govt</th>
						<th>Passport</th>
						<th>Doc</th>
				
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
		      				<td><?php echo $student['phone']; ?></td>
		      				<td><?php echo $sname; ?></td>
		      				<td><?php echo $lcname; ?></td>
		      				<td>
		      					<a href="../<?php echo $student['passport']; ?>">View</a>		
		      				</td>
		      				<td><a target="_blank" href="../<?php echo $student['olevel_path'] ?>">
		      					Doc1
		      				</a>| <a target="_blank" href="../<?php echo $student['jamb_path'] ?>">Doc2</a></td>
		      				
		      			</tr>			
		   		<?php
		   	      }
		   		?>
		   	    </tbody>
		      </table>
	  </div>
		</div><!--close content_item-->
      </div><!--close content-->   
	</div><!--close site_content--> 
<?php require ("footer_admin.php");?>
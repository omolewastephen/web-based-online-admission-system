<?php include 'includes/header.php';?>
<?php
   if(empty($_GET['ref']) OR $_GET['ref'] == ''){
   	redirect_to('payment.php');
   }else{
   	$ref = $_GET['ref'];
   	$result = mysql_query("SELECT * FROM ref WHERE ref_number = '$ref'");
   	confirm_query($result);

   	if(mysql_num_rows($result) == 0){
   		redirect_to('payment.php');
   	}
   }
?>
<style>
#signup-step{padding:0;width:100%}
#signup-step li{list-style:none; float:left;padding:5px 10px;border-top:#a03609 1px solid;border-left:#a03609 1px solid;border-right:#a03609 1px solid;border-radius:5px 5px 0 0;}
.active{color:#FFF;}
#signup-step li.active{background-color:#a03609 ;}
#signup-form{clear:both;border:1px #a03609 solid;padding:20px;width:100%;margin:auto;}
.demoInputBox{padding: 10px;border: #CDCDCD 1px solid;border-radius: 4px;background-color: #FFF;width: 50%;}
.signup-error{color:#FF0000;font-size: 12px}
.message {  color: #fb4314; font-size: 15px;  font-weight: bold;  padding: 10px;  text-align: center; width: 100%;}
.btnAction{padding: 5px 10px;border: 0;color: #FFF;cursor: pointer; margin-top:15px;}
h1{
  margin:3px 0;font-size:13px;  text-decoration:underline;  text-align:center;}
.tLink{
  font-family:tahoma; size:12px;  padding-left:10px;  text-align:center;}
</style>
 <?php
	if (isset($_POST['finish'])) {
	$errors = array();
	$required_field = array('name', 'surname', 'program', 'course', 'gender', 'mstatus', 'state', 
	'phone', 'email', 'local', 'exam', 'result', 'jamb', 'passport','dob','address','jambreg');
	foreach ($required_field as $filedname) {
		if (!isset($_POST[$filedname]) || empty($_POST[$filedname])) {
			$errors[] = $filedname;
		}
	}
	
   $path1 = $path2 = $path3 = '';
	
	//file upload
	$upload_errors = array(UPLOAD_ERR_OK => "No Errors", 
						UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize", 
						UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE", 
						UPLOAD_ERR_PARTIAL => "Partial upload", 
						UPLOAD_ERR_NO_FILE => "No file", 
						UPLOAD_ERR_NO_TMP_DIR => "No temporary directory", 
						UPLOAD_ERR_CANT_WRITE => "Can't write to disk", 
						UPLOAD_ERR_EXTENSION => "File upload stopped by extension", );

	$res1_name = basename($_FILES['result']['name']);
	$tmp_name = $_FILES['result']['tmp_name'];
	$type = $_FILES['result']['type'];
	$max_size = 2097152;
	$size = $_FILES['result']['size'];
	if (isset($res1_name)) {
		$location = 'olevel/';
		$move = move_uploaded_file($tmp_name, $location.$res1_name);
		$path1 = $location.$res1_name;
		if (!$move) {
			$fileerror = $_FILES['result']['error'];
			$message = $upload_errors[$fileerror];
			
		}
	}

	$res2_name = basename($_FILES['jamb']['name']);
	$tmp_name2 = $_FILES['jamb']['tmp_name'];
	$type2 = $_FILES['jamb']['type'];
	$max_size2 = 2097152;
	$size2 = $_FILES['jamb']['size'];
	if (isset($res2_name)) {
		$location2 = 'uploads/';
		$move2 = move_uploaded_file($tmp_name2, $location2.$res2_name);
		$path2 = $location2.$res2_name;
		if (!$move2) {
			$fileerror = $_FILES['jamb']['error'];
			$message = $upload_errors[$fileerror];
		}
	}

	$res3_name = basename($_FILES['passport']['name']);
	$tmp_name3 = $_FILES['passport']['tmp_name'];
	$type3 = $_FILES['passport']['type'];
	$max_size3 = 2097152;
	$size3 = $_FILES['passport']['size'];
	if (isset($res3_name)) {
		$location3 = 'passport/';
		$move3 = move_uploaded_file($tmp_name3, $location3.$res3_name);
		$path3 = $location3.$res3_name;
		if (!$move3) {
			$fileerror = $_FILES['passport']['error'];
			$message = $upload_errors[$fileerror];
		}
	}

    
	$course = $_POST['course'];
	$gender = $_POST['gender'];
	$mstatus = $_POST['mstatus'];
	$program = $_POST['program'];
	$surname = $_POST['surname'];
	$name = $_POST['name'];
	$dob = $_POST['dob'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$local = $_POST['local'];
	$state = $_POST['state'];
	$phone = $_POST['phone'];
	$jambreg = $_POST['jambreg'];
	$exam = $_POST['exam'];


	if (!isset($_POST['declaration'])) {
		$error[] = "Accept the declaration";
	}
	
	$query = "INSERT INTO students
	(
	name,surname,h_address,phone,state_id,jambreg,local,dob,program,mstatus,gender,course,email,jamb_path,olevel_path,passport,exam,ref_number
	)VALUES('$name','$surname','$address','$phone','$state','$jambreg','$local','$dob','$program','$mstatus','$gender','$course','$email','$path2','$path1','$path3','$exam','$ref')";
	$result = mysql_query($query, $connection);
	if ($result) {
		redirect_to("success.php?ref=".$ref);
	} else {
		redirect_to("failed.php?ref=".$ref);
	}
}
?>
      <div id="content">
        <div class="content_item" class="container">
     
        	<div class="col-md-12">
         <?php if (!empty($message)) { echo "<p class=\"errors\">{$message}</p>"; } ?>

          
				<ul id="signup-step">
					<li id="personal" class="active">Bio Data</li>
					<li id="password">Upload Photo</li>
					<li id="general">Upload Result</li>
					<li id="program">Program Application</li>
					<li id="course">Courses</li>
					<li id="attest">Attestation</li>
				</ul>
				
			<form role="form" class="form-horizontal" id="signup-form" method="post" enctype="multipart/form-data">
					<div id="personal-field">
					   <?php include 'includes/forms/bio.php'; ?>
					</div>
					<div id="password-field" style="display:none;">
						<?php include 'includes/forms/passport.php'; ?>
					</div>
					<div id="general-field" style="display:none;">
					    <?php include 'includes/forms/olevel.php'; ?>
					</div>
					<div id="program-field" style="display:none;">
						<?php include 'includes/forms/program.php'; ?>
					</div>
					<div id="course-field" style="display:none;">
						<?php include 'includes/forms/course.php'; ?>
					</div>
					<div id="attest-field" style="display:none;">
						<?php include 'includes/forms/attest.php'; ?>
					</div>
					<div>
						<input class="btnAction btn btn-sm btn-primary" type="button" name="back" id="back" value="Back" style="display:none;">
						<input class="btnAction btn btn-sm btn-primary" type="button" name="next" id="next" value="Next" >
						<input class="btnAction btn btn-sm btn-success" type="submit" name="finish" id="finish" value="Finish" style="display:none;">
					</div>
				</form>
			
			</div>
      </div><!--close content-->  
    </div><!--close site_content-->  
 <?php //include 'includes/footer.php';?>


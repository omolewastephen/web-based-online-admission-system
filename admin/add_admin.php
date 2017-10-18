<?php require ("header_admin.php");?>
<?php

	if (isset($_POST['create_admin'])) {
		$errors = array();

		$required_field = array('username', 'password', 'email');
		foreach ($required_field as $filedname) {
			if (!isset($_POST[$filedname]) || empty($_POST[$filedname])) {
				$errors[] = $filedname;
			}
		}

		$field_with_length = array('username' => 30, 'password' => 30, 'email' => 50);
		foreach ($field_with_length as $filedname => $max_length) {
			if (strlen(trim(mysql_prep($_POST[$filedname]))) > $max_length) {
				$errors[] = $filedname;
			}
		}

		$username = mysql_prep($_POST['username']);
		$password = mysql_prep($_POST['password']);
		$email = mysql_prep($_POST['email']);

		if(empty($errors)) {
			$query = "INSERT INTO admin( 
				username, password, email) 
				VALUES(
				'{$username}', '{$password}', '{$email}')";

			$result = mysql_query($query, $connection);
			confirm_query($result);
			if ($result) {
				$message = "The User was Sucessfully added ";
			} else {
				$message = "The user could not be created.";
				$message .= "<br />" . mysql_error();
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		
	} else {
		$username = "";
		$password = "";
		$email = "";
	}

?>
	  <div id="content">
        <div class="content_item">
		  <h2>Create a new User</h2>
            <p class="selected"><center>Fill in the Details :</center></p>
            <?php if (!empty($message)) { echo "<p class=\"errors\">{$message}</p>"; } ?>
            <?php if (!empty($errors)) { echo "<p class=\"errors\">Please review the following field : <br />";
                                  foreach ($errors as $error) {echo "- {$error}<br />"; } echo "</p>";} ?>
            <form action="" method="POST">
	        <p><strong><h3>Login Information</h3></strong></p>
            <div style="width:200px; float:left;"><p>Username</p></div>
	        <div style="width:430px; float:right;"><p><input class="contact" type="text" name="username" value="<?php echo htmlentities($username); ?>" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Password</p></div>
    	    <div style="width:430px; float:right;"><p><input class="contact" type="password" name="password" value="<?php echo htmlentities($password); ?>" /></p></div>
            <br style="clear:both;" />
            <p><strong><h3>Personal Information</h3></strong></p>
            <div style="width:200px; float:left;"><p>Country</p></div>
			       <div style="width:430px; float:right;"><p>
			       <select style="width:155px;">
				       <option>India</option>
				       <option>Others</option>
			       </select>
			       </p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Gender</p></div>
			<div style="width:430px; float:right;"><p>
		       <input class="contact" type="radio" name="gender" value="male" checked />Male
		       &nbsp; &nbsp;
		       <input class="contact" type="radio" name="gender" value="female" />Female
		       </p></div>
            <br style="clear:both;" >
            <div style="width:200px; float:left;"><p>Maritial Status</p></div>
		       <div style="width:430px; float:right;"><p>
		       <select style="width:155px;">
			       <option>Married</option>
			       <option selected>Unmarried</option>
		       </select>
		       </p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>E_mail Id</p></div>
	        <div style="width:430px; float:right;"><p><input class="contact" type="text" name="email" value="<?php echo htmlentities($email); ?>" /></p></div>
            <br style="clear:both;" />
	        <div style="width:430px; float:right;"><p style="padding-top: 15px"><input class="submit" type="submit" name="create_admin" value=" Create User " /></p></div>
            </form>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p><a href="index.php">Return to main page</a></p></div>            
		</div><!--close content_item-->
      </div><!--close content-->
	</div><!--close site_content-->
<?php require ("footer_admin.php");?>
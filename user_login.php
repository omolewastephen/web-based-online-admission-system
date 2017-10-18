<?php include 'includes/header.php';?>
<?php sidebar_navigation_id();?>
<?php session_start(); ?>
<?php
	if (isset($_POST['user_login'])) {
		$errors = array();

		$required_field = array('username', 'password');
		foreach ($required_field as $filedname) {
			if (!isset($_POST[$filedname]) || empty($_POST[$filedname])) {
				$errors[] = $filedname;
			}
		}

		$field_with_length = array('username' => 30, 'password' => 30);
		foreach ($field_with_length as $filedname => $max_length) {
			if (strlen(trim(mysql_prep($_POST[$filedname]))) > $max_length) {
				$errors[] = $filedname;
			}
		}

		$username = mysql_prep($_POST['username']);
		$password = mysql_prep($_POST['password']);
		
		if(empty($errors)) {
			$query = "SELECT id, username ";
			$query .= "FROM students ";
			$query .= "WHERE username = '{$username}' ";
			$query .= "AND password = '{$password}' ";
			$query .= "LIMIT 1";
			$result = mysql_query($query, $connection);
			confirm_query($result);
			if (mysql_num_rows($result) == 1) {
				//user authebticated
				$found_user = mysql_fetch_array($result);
				$_SESSION['id'] = $found_user['id'];
				$_SESSION['username'] = $found_user['username'];
				redirect_to("index.php");
			} else {
				$message = "The username/password is incorrect.";
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		
	} else {
		if (isset($_GET['logout']) && $_GET['logout'] == 1) {
			$message = "You are now logged out";
		}
		$username = "";
		$password = "";
		$c_password= "";
	}

?>
	  <div id="content">
        <div class="content_item">
		  <h2>Welcome</h2>
            <p class="selected">Log In to Continue :</p>
            <?php if (!empty($message)) { echo "<p class=\"errors\">{$message}</p>"; } ?>
            <?php if (!empty($errors)) { echo "<p class=\"errors\">Please review the following field : <br />";
                                  foreach ($errors as $error) {echo "- {$error}<br />"; } echo "</p>";} ?>
            <form action="" method="POST">
	            <div style="width:120px; float:left;"><p>Username</p></div>
				<div style="width:430px; float:right;"><p><input class="contact" type="text" name="username" value="" /></p></div>
	            <br style="clear:both;" />
	            <div style="width:120px; float:left;"><p>Password</p></div>
		        <div style="width:430px; float:right;"><p><input class="contact" type="password" name="password" value="" /></p></div>
	            <br style="clear:both;" />
	            <div style="width:430px; float:right;"><p style="padding-top: 15px"><input class="submit" type="submit" name="user_login" value=" Log In " /></p></div>
            </form>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p><a href="./index.php">Return to Public site</a></p></div>                        
		</div><!--close content_item-->
      </div><!--close content-->  
	</div><!--close site_content-->
<?php require ("footer_admin.php");?>
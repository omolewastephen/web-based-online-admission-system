<?php require_once ("../includes/connection.php");?>
<?php require_once ("../includes/functions.php");?>
<?php sidebar_navigation_id();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
  <title>Gateway Polytechnic Administrative</title>
  <meta name="description" content="website" />
  <meta name="keywords" content="enter your keywords here" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/image_slide.js"></script>
</head>

<body>
  <div id="main">
    <div id="header">
    <div id="banner">
      <div id="welcome">
        <h1>Gateway Poly Admin</h1>
      </div><!--close welcome-->
      <div id="welcome_slogan">
        <h1>Online Admission System</h1>
      </div><!--close welcome_slogan-->
    </div><!--close banner-->
    </div><!--close header-->
<?php $basename = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);?>
  <div id="menubar">
      <ul id="menu">
        <li <?php if ($basename == 'programs') echo ' class="current"'; ?>><a href="programs.php">Programs</a></li>
        <li <?php if ($basename == 'courses') echo ' class="current"'; ?>><a href="courses.php">Courses</a></li>
        <li <?php if ($basename == 'fees') echo ' class="current"'; ?>><a href="fees.php">Fees</a></li>
        <li <?php if ($basename == 'students') echo ' class="current"'; ?>><a href="students.php">Student</a></li>
        <li <?php if ($basename == 'admission') echo ' class="current"'; ?>><a href="admission.php">Admission</a></li>
      </ul>
    </div><!--close menubar-->  
    
  <div id="site_content">   

    <div class="sidebar_container">       
    <div class="sidebar">
          <div class="sidebar_item">
            <h2>Latest Update</h2>
      </div><!--close sidebar_item--> 
        </div><!--close sidebar-->
         <?php
              $page_set = get_all_page();
              while ($page = mysql_fetch_array($page_set)) {
                echo "<div class=\"sidebar\">
                      <div class=\"sidebar_item\">
                      <h3";
                      if($page['id'] == $sel_page) {
                        echo " class=\"selected\"";
                      }
                      
                      echo "><a href=\"edit_update.php?page=" . urlencode($page['id']) . "\">{$page['menu_name']}</a></h3>
                      <p><a href=\"edit_update.php?page=" . urlencode($page['id']) . "\">{$page['content']}</a></p>
                  </div><!--close sidebar_item--> 
                </div><!--close sidebar-->";
              }
            ?>
        <div class="sidebar">
          <div class="sidebar_item">
            <h3><a href="new_update.php">+ Add a new Update</a></h3>
          </div><!--close sidebar_item-->
        </div><!--close sidebar-->
        <div class="sidebar">
          <div class="sidebar_item">
            <h2>Contact</h2>
           <p style="font-size: 10px">Phone: +2348073047104</p>
            <p style="font-size: 10px">Developed by: <a href="facebook.com/createnetworksng">Create Networks NG</a></p>
            <p style="font-size: 10px">Email: <a href="mailto:info@omolewastephen@gmail.com">omolewastephen@gmail.com</a></p>
          </div><!--close sidebar_item--> 
        </div><!--close sidebar-->
       </div><!--close sidebar_container-->
  <?php sidebar_navigation_id();?>
  <?php session_start(); ?>
<?php
	if (isset($_POST['login'])) {
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
			$query .= "FROM admin ";
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
				$message = "The username/password is incorrect.There are".mysql_num_rows($result)."users with same name";
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
		$email = "";
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
	            <div style="width:430px; float:right;"><p style="padding-top: 15px"><input class="submit" type="submit" name="login" value=" Log In " /></p></div>
            </form>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p><a href="../index.php">Return to Public site</a></p></div>
		</div><!--close content_item-->
      </div><!--close content-->   
	</div><!--close site_content--> 
<?php require ("footer_admin.php");?>
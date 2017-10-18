<?php require_once ("includes/session.php");?>
<?php include 'includes/header.php';?>
<?php
	if (!isset($_SESSION['user_id'])) {
		redirect_to("signin.php");
	}
?>

<?php
  $errors = array();

  if (isset($_POST['change_pass'])) {
    $required_field = array('email', 'old_pass', 'new_pass');
    foreach ($required_field as $fieldname) {
      if (!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]))) {
        $errors[] = $fieldname;
      }
    }

    $field_with_length = array('email' => 30, 'old_pass' => 30, 'new_pass' => 30);
    foreach ($field_with_length as $fieldname => $max_length) {
      if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $max_length) {
        $errors[] = $fieldname;
      }
    }

    if (empty($errors)) {
      $id = $_SESSION['user_id'];
      $email = $_POST['email'];
      $old_pass = $_POST['old_pass'];
      $new_pass = $_POST['new_pass'];

      $test = mysql_fetch_array(mysql_query("SELECT * FROM students WHERE id = {$id}"));
      if (($test['email'] == $email) && ($test['password']) == $old_pass) {

      $query = "UPDATE students SET 
                password = {$new_pass}, 
                WHERE id = {$id}";

      $result = mysql_query($query, $connection);
      confirm_query($result);
      if (mysql_affected_rows() == 1) {
        $message = "The Password was successfully Updated";
      } else {
        $message = "The Password Update failed <br>";
        $message .= mysql_error();
      }
    } else {
	$message = "The E-mail/Password entered is wrong";
	} 
  } else {
      $message = "There were ". count($errors) ."errors in form";
    }
}



?>
    <div id="content">
        <div class="content_item">
            <h2>Change Password :</h2>
            <?php if (!empty($message)) { echo "<p class=\"errors\">{$message}</p>"; } ?>
            <?php if (!empty($errors)) { echo "<p class=\"errors\">Please review the following field : <br />";
                                  foreach ($errors as $error) {echo "- {$error}<br />"; } echo "</p>";} ?>
            <h3>Welcome <?php echo $_SESSION['username']?></h3>
            <br style="clear:both;" />
            <form action="change_pass.php" method="POST">
              <div style="width:120px; float:left;"><p>E-mail Id</p></div>
              <div style="width:430px; float:right;"><p><input class="contact" type="text" name="email" value="" /></p></div>
              <br style="clear:both;" />
              <div style="width:120px; float:left;"><p>Old Password</p></div>
              <div style="width:430px; float:right;"><p><input class="contact" type="password" name="old_pass" value="" /></p></div>
              <br style="clear:both;" />
              <div style="width:120px; float:left;"><p>New Password</p></div>
              <div style="width:430px; float:right;"><p><input class="contact" type="password" name="new_pass" value="" /></p></div>
              <br style="clear:both;" />
              <div style="width:430px; float:right;"><p style="padding-top: 15px"><input class="submit" type="submit" name="change_pass" value=" Change Password " /></p></div>
              &nbsp;&nbsp;
            </form>
            <br style="clear:both;" />
            <div style="width:120px; float:left;"><p><a href="student.php?sid=<?php echo $_SESSION['user_id']?>">Cancel</a></p></div>
        </div><!--close content_item-->
      </div><!--close content-->   
  </div><!--close site_content--> 

<?php include 'includes/footer.php';?>
<?php require 'includes/header.php';?>
<?php
  if (isset($_POST['contact_submitted'])) {
  $errors = array();

  $required_field = array('name', 'email', 'message');
  foreach ($required_field as $filedname) {
    if (!isset($_POST[$filedname]) || empty($_POST[$filedname])) {
      $errors[] = $filedname;
    }
  }

  $field_with_length = array('name' => 30, 'email' => 30, 'message' => 150);
  foreach ($field_with_length as $filedname => $max_length) {
    if (strlen(trim(mysql_prep($_POST[$filedname]))) > $max_length) {
      $errors[] = $filedname;
    }
  }

  $name = mysql_prep($_POST['name']);
  $email = mysql_prep($_POST['email']);
  $message = mysql_prep($_POST['message']);

  if (empty($errors)) {
    global $connection;
    $query = "INSERT INTO contact( 
      name, email, message) 
      VALUES(
      '{$name}', '{$email}', '{$message}')";
    $result = mysql_query($query, $connection);
    if ($result) {
      redirect_to("contact.php?contact=1");
    } else {
      echo "Subject Creation failed ".mysql_error();
    }
  }
}else {
    if (isset($_GET['contact']) && $_GET['contact'] == 1) {
        $message = "Query Successfully Submitted We will be in touch with you soon";
    }
}
?>
      <div id="content">
        <div class="content_item">
            <h2>Contact Us</h2>
            <?php if (!empty($message)) { echo "<p class=\"errors\">{$message}</p>"; } ?>
            <?php if (!empty($errors)) { echo "<p class=\"errors\">Please review the following field : <br />";
                                  foreach ($errors as $error) {echo "- {$error}<br />"; } echo "</p>";} ?>
            <form method="post" action="contact.php">
            <p>Enter your query here:</p>
            <div style="width:120px; float:left;"><p>Name</p></div>
			       <div style="width:430px; float:right;"><p><input class="contact" type="text" name="name" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:120px; float:left;"><p>Email Address</p></div>
			       <div style="width:430px; float:right;"><p><input class="contact" type="text" name="email" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:120px; float:left;"><p>Message</p></div>
			       <div style="width:430px; float:right;"><p><textarea class="contact textarea" rows="8" cols="50" name="message"></textarea></p></div>
            <br style="clear:both;" />
            <p style="padding: 10px 0 10px 0;">
            Please enter the answer to this simple maths question (to prevent spam)</p>
            <div style="width:120px; float:left;"><p>Maths: 9 + 3 = ?</p></div>
			      <div style="width:430px; float:right;"><p>
            <input type="text" name="user_answer" class="contact" />
            <input type="hidden" name="answer" value="4d76fe9775" /></p></div>
            <div style="width:430px; float:right;"><p style="padding-top: 15px">
            <input class="submit" type="submit" name="contact_submitted" value="Send" /></p></div>
            </form>
        </div><!--close content_item-->
      </div><!--close content-->  
    </div><!--close site_content-->  
<?php include 'includes/footer.php';?>
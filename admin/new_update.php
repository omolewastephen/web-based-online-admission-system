<?php require ("header_admin.php");?>  
<?php
  if (isset($_POST['update_added'])) {
  $errors = array();

  $required_field = array('menu_name', 'position', 'content');
  foreach ($required_field as $filedname) {
    if (!isset($_POST[$filedname]) || empty($_POST[$filedname])) {
      $errors[] = $filedname;
    }
  }

  $field_with_length = array('menu_name' => 30, 'content' => 150);
  foreach ($field_with_length as $filedname => $max_length) {
    if (strlen(trim(mysql_prep($_POST[$filedname]))) > $max_length) {
      $errors[] = $filedname;
    }
  }

  $menu_name = mysql_prep($_POST['menu_name']);
  $position = mysql_prep($_POST['position']);
  $content = mysql_prep($_POST['content']);


    global $connection;
    $query = "INSERT INTO pages( 
      menu_name, position, content) 
      VALUES(
      '{$menu_name}', '{$position}', '{$content}')";
    $result = mysql_query($query, $connection);
    if ($result) {
      redirect_to("index.php");
    } else {
      echo "Subject Creation failed ".mysql_error();
    }
  }

?>
    <div id="content">
        <div class="content_item">
            <h2>Welcome Admin</h2>
            <h3>Add Latest Update : </h3>
            <?php if (!empty($message)) { echo "<p class=\"errors\">{$message}</p>"; } ?>
            <?php if (!empty($errors)) { echo "<p class=\"errors\">Please review the following field : <br />";
                                  foreach ($errors as $error) {echo "- {$error}<br />"; } echo "</p>";} ?>
            <br style="clear:both;" />
            <form action="new_update.php" method="POST">
              <div style="width:120px; float:left;"><p>Update Heading</p></div>
               <div style="width:430px; float:right;"><p><input class="contact" type="text" name="menu_name" value="" /></p></div>
              <br style="clear:both;" />
              <div style="width:200px; float:left;"><p>Position</p></div>
             <div style="width:430px; float:right;"><p>
             <select style="width:155px;" name="position">
             <?php 
                $update_count = mysql_num_rows($page_set);
                for ($i=1; $i <= $update_count+1; $i++) { 
                  echo "<option value=\"{$i}\">{$i}</option>";
                }
             ?>
             </select>
             </p></div>
             <br style="clear:both;" />
              <div style="width:120px; float:left;"><p>Update Content</p></div>
               <div style="width:430px; float:right;">
                <p><textarea class="contact textarea" rows="8" cols="50" name="content"></textarea></p></div>
              <br style="clear:both;" />
              <div style="width:430px; float:right;"><p style="padding-top: 15px"><input class="submit" type="submit" name="update_added" value="Add" /></p></div>
            </form>
            <br style="clear:both;" />
            <div style="width:120px; float:left;"><p><a href="index.php">Cancel</a></p></div>
        </div><!--close content_item-->
      </div><!--close content-->   
  </div><!--close site_content--> 
<?php require ("footer_admin.php");?>
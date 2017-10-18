<?php require_once ("../includes/session.php");?>
<?php confirm_logged_in(); ?>
<?php require ("header_admin.php");?>
<?php
  if (intval($_GET['page']) == 0) {
    redirect_to("index.php");
  }

  $errors = array();

  if (isset($_POST['update_added'])) {
    $required_field = array('menu_name', 'position', 'content');
    foreach ($required_field as $fieldname) {
      if (!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]))) {
        $errors[] = $fieldname;
      }
    }

    $field_with_length = array('menu_name' => 30, 'content' => 150);
    foreach ($field_with_length as $fieldname => $max_length) {
      if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $max_length) {
        $errors[] = $fieldname;
      }
    }


      $id = $_GET['page'];
      $menu_name = $_POST['menu_name'];
      $position = $_POST['position'];
      $content = $_POST['content'];

      $query = "UPDATE pages SET 
                menu_name = '{$menu_name}', 
                position = {$position}, 
                content = '{$content}' 
                WHERE id = {$id}";

      $result = mysql_query($query, $connection);
      confirm_query($result);
      if (mysql_affected_rows() == 1) {
        $message = "The Page was successfully Updated";
      } else {
        $message = "The Page Update failed <br>";
        $message .= mysql_error();
      }

  }
?>
<?php  ?>
    <div id="content">
        <div class="content_item">
            <h2>Welcome Admin</h2>
            <?php if (!empty($message)) { echo "<p class=\"errors\">{$message}</p>"; } ?>
            <?php if (!empty($errors)) { echo "<p class=\"errors\">Please review the following field : <br />";
                                  foreach ($errors as $error) {echo "- {$error}<br />"; } echo "</p>";} ?>
            <h3>Edit Latest Update : </h3>
            <br style="clear:both;" />
            <form action="edit_update.php?page=<?php echo urlencode($sel_page_array['id']); ?>" method="POST">
              <div style="width:120px; float:left;"><p>Update Heading</p></div>
               <div style="width:430px; float:right;"><p><input class="contact" type="text" name="menu_name" value="<?php echo $sel_page_array['menu_name']; ?>" /></p></div>
              <br style="clear:both;" />
              <div style="width:200px; float:left;"><p>Position</p></div>
             <div style="width:430px; float:right;"><p>
             <select style="width:155px;" name="position">
             <?php 
                $update_count = mysql_num_rows(get_all_page());
                for ($i=1; $i <= $update_count; $i++) { 
                  echo "<option value=\"{$i}\"";
                  if ($sel_page_array['id'] == $i) {
                    echo " selected";
                  }
                  echo ">{$i}</option>";
                }
             ?>
             </select>
             </p></div>
              <br style="clear:both;" />
              <div style="width:120px; float:left;"><p>Update Content</p></div>
               <div style="width:430px; float:right;">
                <p><textarea class="contact textarea" rows="8" cols="50" name="content"><?php echo $sel_page_array['content']; ?></textarea></p></div>
              <br style="clear:both;" />
              <div style="width:430px; float:right;"><p style="padding-top: 15px"><input class="submit" type="submit" name="update_added" value=" Update " /></p></div>
              &nbsp;&nbsp;
              <a href="delete_update.php?page=<?php echo urlencode($sel_page_array['id']); ?> ">Delete Page</a>
            </form>
            <br style="clear:both;" />
            <div style="width:120px; float:left;"><p><a href="index.php">Cancel</a></p></div>
        </div><!--close content_item-->
      </div><!--close content-->   
  </div><!--close site_content--> 
<?php require ("footer_admin.php");?>
<?php require ("header_admin.php");?>  
<?php
  if (isset($_POST['add_program'])) {
  $errors = array();

  $required_field = array('type', 'code', 'name', 'fee', 'description', 'num_semester', 'duration', 
  	'eligibility', 'max_duration');
  foreach ($required_field as $filedname) {
    if (!isset($_POST[$filedname]) || empty($_POST[$filedname])) {
      $errors[] = $filedname;
    }
  }

  $field_with_length = array('name' => 50, 'code' => 10, 'eligibility' => 200, 'description' => 500);
  foreach ($field_with_length as $filedname => $max_length) {
    if (strlen(trim(mysql_prep($_POST[$filedname]))) > $max_length) {
      $errors[] = $filedname;
    }
  }

  $name = mysql_prep($_POST['name']);
  $code = mysql_prep($_POST['code']);
  $type = mysql_prep($_POST['type']);
  $description = mysql_prep($_POST['description']);
  $num_semester = mysql_prep($_POST['num_semester']);
  $duration = mysql_prep($_POST['duration']);
  $eligibility = mysql_prep($_POST['eligibility']);
  $max_duration = mysql_prep($_POST['max_duration']);


  if (empty($errors)) {
    global $connection;
    $query = "INSERT INTO programs( 
      type, code, name, description, num_semester, duration, eligibility, max_duration) 
      VALUES(
     '{$type}', '{$code}', '{$name}', '{$description}', '{$num_semester}', '{$duration}', 
     '{$eligibility}', '{$max_duration}')";
    $result = mysql_query($query, $connection);
    if ($result) {
      redirect_to("index.php?prog=1");
    } else {
      echo "Subject Creation failed ".mysql_error();
    }
  }
}
?>
    <div id="content">
        <div class="content_item">
            <h2>Welcome <?php echo $_SESSION['username'];?></h2>
            <h3>Add a new Program : </h3>
            <?php if (!empty($message)) { echo "<p class=\"errors\">{$message}</p>"; } ?>
            <?php if (!empty($errors)) { echo "<p class=\"errors\">Please review the following field : <br />";
                                  foreach ($errors as $error) {echo "- {$error}<br />"; } echo "</p>";} ?>
            <br style="clear:both;" />
            <form action="programs.php" method="POST">
            <div style="width:200px; float:left;"><p>Select</p></div>
			<div style="width:430px; float:right;"><p>
			<select style="width:155px;" name="type">
				<option>Masters Degree</option>
				<option>Bachelors Degree</option>
			</select>
			</p></div>
            <br style="clear:both;" />
            <div style="width:120px; float:left;"><p>Code</p></div>
            <div style="width:430px; float:right;"><p><input class="contact" type="text" name="code" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Name</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="name" value="" /></p></div>
     
           
            <br style="clear:both;" />
            <div style="width:120px; float:left;"><p>Program Description</p></div>
            <div style="width:430px; float:right;">
            <p><textarea class="contact textarea" rows="7" cols="30" name="description"></textarea></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>No. of Semesters</p></div>
            <div style="width:430px; float:right;"><p>
            <select style="width:155px;" name="num_semester">
            <?php 
               for ($i=1; $i <= 8; $i++) { 
                 echo "<option value=\"{$i}\">{$i}</option>";
               }
            ?>
            </select>
            </p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Course Duration</p></div>
            <div style="width:430px; float:right;"><p>
            <select style="width:155px;" name="duration">
            <?php 
               for ($i=1; $i <= 5; $i++) { 
                 echo "<option value=\"{$i}\">{$i} Year</option>";
               }
            ?>
            </select>
            </p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Maximum Duration</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="max_duration" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Eligibility</p></div>
            <div style="width:430px; float:right;">
            <p><textarea class="contact textarea" rows="6" cols="28" name="eligibility"></textarea></p></div>
            <br style="clear:both;" />
            <div style="width:430px; float:right;"><p style="padding-top: 15px">
            <input class="submit" type="submit" name="add_program" value=" Add Program " /></p></div>
            </form>
            <br style="clear:both;" />
            <div style="width:120px; float:left;"><p><a href="index.php">Cancel</a></p></div>
        </div><!--close content_item-->
      </div><!--close content-->   
  </div><!--close site_content--> 
<?php require ("footer_admin.php");?>
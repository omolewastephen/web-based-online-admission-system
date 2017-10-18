<div class="form-group">
  <label class="control-label col-md-3">Select Course</label>
  <div class="col-md-9">
<select name="course" id="course" class="form-control" required>
<?php
	$program_result = mysql_query("SELECT name,id FROM programs");
	while ($array = mysql_fetch_array($program_result)) {
		$course_id = $array['id'];
		echo "<option value='{$course_id}'>{$array['name']}</option>";
	}
?>
</select>
 <span id="course-error" class="signup-error help-block"></span>
</div>
</div>
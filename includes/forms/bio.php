

<div class="form-group">
  <label class="control-label col-md-2">First Name</label>
  <div class="col-md-10">
  <input type="text" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>" name="name" id="name" class="demoInputBox form-control" required/>
    <span id="name-error" class="signup-error help-block"></span>
</div>
</div>


<div class="form-group">
  <label class="control-label col-md-2">Surname</label>
  <div class="col-md-10">
  <input type="text" value="<?php if(isset($_POST['surname'])){echo $_POST['surname'];} ?>" name="surname" id="surname" class="demoInputBox form-control" required/>
    <span id="surname-error" class="signup-error help-block"></span>
</div>
</div>



<div class="form-group">
<label class="control-label col-md-2">Gender</label>
  <div class="col-md-4">
 <select class="form-control" name="gender" id="gender" required>
 	<option value="M">Male</option>
 	<option value="F">Female</option>
 	 <span id="gender-error" class="signup-error help-block"></span>
 </select>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-2">Status</label>
  <div class="col-md-4">
	<select class="form-control" name="mstatus" id="mstatus" required>

		<option value="single">Single</option>
		<option value="married">Married</option>
	</select>
	<span id="mstatus-error" class="signup-error help-block"></span>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-2">Email</label>
  <div class="col-md-10">
<input type="text" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" id="email" class="demoInputBox form-control" required />
<span id="email-error" class="signup-error help-block"></span>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-2">Phone</label>
  <div class="col-md-10">
<input type="text" name="phone" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>" id="phone" class="demoInputBox form-control" required />
<span id="phone-error" class="signup-error help-block"></span>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-2">Address</label>
  <div class="col-md-6">
<textarea class="form-control" value="<?php if(isset($_POST['address'])){echo $_POST['address'];} ?>" name="address" id="address" required></textarea>
<span id="address-error" class="signup-error help-block"></span>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-2">Dob</label>
  <div class="col-md-10">
<input type="text" value="<?php if(isset($_POST['dob'])){echo $_POST['dob'];} ?>" placeholder="dd/mm/yyyy" name="dob" id="dob" class="demoInputBox form-control" required />
<span id="dob-error" class="signup-error help-block"></span>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-2">State</label>
  <div class="col-md-4">
<select name="state" class="form-control" id="state" required>

	<?php
		$state_result = mysql_query("SELECT * FROM states");
		while ($array = mysql_fetch_array($state_result)) {
			echo "<option value='{$array['state_id']}'>{$array['name']}</option>";
		}
	?>
</select>
<span id="state-error" class="signup-error help-block"></span>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-2">Local Govt</label>
  <div class="col-md-4">
<select name="local" class="form-control" id="local" required>
	<option value="" selected>Select..</option>
	<?php
		$local_result = mysql_query("SELECT * FROM locals");
		while ($array = mysql_fetch_array($local_result)) {
			echo "<option value='{$array['local_id']}'>{$array['local_name']}</option>";
		}
	?>
</select>
<span id="local-error" class="signup-error help-block"></span>
</div>
</div>


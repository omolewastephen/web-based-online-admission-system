<?php require_once ("../includes/connection.php");?>
<?php require_once ("../includes/functions.php");?>
<?php require_once ("../includes/session.php");?>
<?php
if(isset($_POST['accept'])){
	$id=$_POST['selector'];
    $N = count($id);
	for($i=0; $i < $N; $i++)
	{
		 $query = mysql_query("UPDATE students SET admission_status = 1 where id = '$id[$i]'");
		 confirm_query($query);
	}
    header("location: addmissions.php");
}
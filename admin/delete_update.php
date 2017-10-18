<?php require_once ("../includes/session.php");?>
<?php confirm_logged_in(); ?>
<?php require ("header_admin.php");?>
<?php
  if (intval($_GET['page']) == 0) {
    redirect_to("index.php");
  }

  $id = mysql_prep($_GET['page']);
  echo "Your id is ".$id;

  if ($page = get_all_page_by_id($id)) {
    $query = "DELETE FROM pages WHERE id = {$id} LIMIT 1";
  	$result = mysql_query($query, $connection);
  	if (mysql_affected_rows() == 1) {
  		redirect_to("index.php");
  	} else {
  		//deletion failed
  		echo "<p>Page deletion failed</p>";
  		echo "<p>". mysql_error() ."</p>";
  		echo "<p><a href=\"index.php\">Return to Main Page</a></p>";
  	}
  } else {
  	//subject doesnt exist
  	redirect_to("index.php");
  }
?>
<?php require ("footer_admin.php");?>
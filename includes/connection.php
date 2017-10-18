<?php 
 error_reporting(1);
 require("constants.php"); ?>
<?php
	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	if (!$connection) {
		die('connection to database failed Check Server name user name or password<br> in constants.php file in includes folder<br> <br>'.mysql_error());
	}

	$db_select = mysql_select_db(DB_NAME, $connection);
	if (!$db_select) {
		mysql_query("CREATE DATABASE IF NOT EXISTS DB_NAME");
		system('mysql -u <DB_USER> -p<DB_PASS> DB_NAME < database.sql');
		header("Location: index.php");
		exit;
	}
?>
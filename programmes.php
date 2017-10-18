<?php require_once ("includes/header.php");?>
	<div id="content">
        <div class="content_item">
        <h2>Programmes : </h2>
        <?php
            if (!isset($_GET['program'])) {
            echo "<br style=\"clear:both;\" />
                <p><ol>";
                $query = "SELECT * FROM programs";
                $result = mysql_query($query);
                confirm_query($result);
                while ($program_array = mysql_fetch_array($result)) {
                    echo "<li><a href=\"programmes.php?program=";
                    echo $program_array['id'];
                    echo "\">{$program_array['code']}  |  {$program_array['name']}</a></li>";
                }
                echo "</ol></p>";
            }
            ?>
<?php
    if (isset($_GET['program'])) {
    $query = "SELECT * FROM programs WHERE id = {$_GET['program']}";
    $result = mysql_query($query);
    confirm_query($result);
    $sel_program_array = mysql_fetch_array($result);    
    $program_fields = array('type', 'code', 'name', 'fee', 'description', 'num_semester', 
                   	'duration', 'eligibility', 'max_duration');
    foreach ($program_fields as $fieldname) {
       	echo "<div style=\"width:120px; float:left;\"><p><h3><b>{$fieldname}</b></h3></p></div>
   		<div style=\"width:430px; float:right;\"><p>{$sel_program_array[$fieldname]}</p></div>
  		<br style=\"clear:both;\" />";
    }
    echo "<br style=\"clear:both;\" /><p><a href=\"programmes.php\">Go Back</a></p>";
}
?>
            
        </div><!--close content_item-->
    </div><!--close content-->  
</div><!--close site_content-->
<?php include 'includes/footer.php';?>
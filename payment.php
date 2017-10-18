<?php include 'includes/header.php';?>
      <div id="content">
        <div class="content_item" class="container">
        	<div class="col-md-12">
        		<div class="well well-md">
               <h3>
               	Enter your payment reference number to continue
               </h3>
               <form class="form-horizontal" method="post">
                <div class="form-group">
                 <label class="control-label col-md-3">Reference Number:</label>
                 <div class="col-md-6">
                   <input type="text" name="ref" id="ref" placeholder="gtpxxxxxxxx" class="form-control has_warning" required>
                  </div>
                </div>
                <div class="form-group">
                <label class="col-md-3"></label>
                 &nbsp; &nbsp;<button type="submit" name="submit" class="btn btn-md btn-default">Continue</button>
               </div>
               </form>
               <?php 
               if(isset($_POST['submit'])){
                $ref = $_POST['ref'];

                $query = "SELECT * FROM ref WHERE ref_number = '$ref'";
                $result = mysql_query($query,$connection);
                confirm_query($result);

                if(mysql_num_rows($result) == 0){
                  echo "<script>alert('Invalid Reference Number, Kindly retry.')</script>";
                }else{

                  $found = mysql_fetch_array($result);
                  $used = $found['used'];
                  $ref_number = $found['ref_number'];

                  if($used == 1){
                     echo "<script>alert('Reference Number has been used.')</script>";
                  }else{
                     
                      mysql_query("UPDATE ref SET used = 1 WHERE ref_number = '$ref_number'");

                      echo "<script>alert('Successfully! Close the dialog to  redirect.')</script>";

                      redirect_to('admissions.php?ref='.$ref_number);
                  }
                }
               }

               ?>
               </div>	 
			</div>
      </div><!--close content-->  
    </div><!--close site_content-->  
 <?php //include 'includes/footer.php';?>
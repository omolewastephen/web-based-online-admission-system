<?php require_once ("includes/session.php");?>
<?php include 'includes/header.php';?>
<?php
    if (isset($_SESSION['user_id'])) {
        redirect_to("student.php?sid={$_SESSION['user_id']}");
    }
?>
<?php
    if (isset($_POST['user_login'])) {
        $errors = array();

        $required_field = array('username', 'password');
        foreach ($required_field as $filedname) {
            if (!isset($_POST[$filedname]) || empty($_POST[$filedname])) {
                $errors[] = $filedname;
            }
        }

        $field_with_length = array('username' => 30, 'password' => 30);
        foreach ($field_with_length as $filedname => $max_length) {
            if (strlen(trim(mysql_prep($_POST[$filedname]))) > $max_length) {
                $errors[] = $filedname;
            }
        }

        $username = mysql_prep($_POST['username']);
        $password = mysql_prep($_POST['password']);
        
        if(empty($errors)) {
            $query = "SELECT id, jambreg,surname ";
            $query .= "FROM students ";
            $query .= "WHERE jambreg = '{$username}' ";
            $query .= "AND surname = '{$password}' ";
            $query .= "LIMIT 1";
            $result = mysql_query($query, $connection);
            confirm_query($result);
            if (mysql_num_rows($result) == 1) {
                //user authebticated
                $found_user = mysql_fetch_array($result);
                $_SESSION['user_id'] = $found_user['id'];
                $_SESSION['username'] = $found_user['surname'];
                redirect_to("student.php?sid={$found_user['id']}");
            } else {
                $message = "The username/password is incorrect.";
            }
        } else {
            //nothing
        }
        
    } else {
        if (isset($_GET['logout']) && $_GET['logout'] == 1) {
            $message = "You are now logged out. Please Sign in to Continue";
        }
        if (isset($_GET['login']) && $_GET['login'] == 1) {
            $message = "Sucessfully Registered Sign in to Continue";
        }
        $username = "";
        $password = "";
        $c_password= "";
    }

?>
      <div id="content">
        <div class="content_item">
          <h2>Welcome</h2>
            <p class="selected">Log In to Continue :</p>
            <?php if (!empty($message)) { echo "<p class=\"alert alert-success\">{$message}</p>"; } ?>
            <?php if (!empty($errors)) { echo "<p class=\"alert alert-danger\">Please review the following field : <br />";
                                  foreach ($errors as $error) {echo "- {$error}<br />"; } echo "</p>";} ?>
            <form action="" method="POST">
                <div style="width:120px; float:left;"><p>Jamb Reg. Number</p></div>
                <div style="width:430px; float:right;"><p><input class="contact form-control" type="text" name="username" value=""  /></p></div>
                <br style="clear:both;" />
                <div style="width:120px; float:left;"><p>Surname</p></div>
                <div style="width:430px; float:right;"><p><input class="contact form-control" type="password" name="password" value="" /></p></div>
                <br style="clear:both;" />
                <div style="width:430px; float:right;"><p style="padding-top: 15px"><input class="submit btn btn-md btn-primary" type="submit" name="user_login" value=" Log In " /></p></div>
            </form>
            <br style="clear:both;" />
        </div><!--close content_item-->
      </div><!--close content-->  
    </div><!--close site_content-->
<?php include 'includes/footer.php';?>
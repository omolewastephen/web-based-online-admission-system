<?php require_once ("includes/session.php");?>
<?php require_once ("includes/connection.php");?>
<?php require_once ("includes/functions.php");?>
<?php sidebar_navigation_id();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
  <title>Gateway Polytechnic,Saapade</title>
  <meta name="description" content="website" />
  <meta name="keywords" content="enter your keywords here" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
   <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="js/image_slide.js"></script>
  <script>
function validate() {
var output = true;
$(".signup-error").html('');
if($("#personal-field").css('display') != 'none') {
  if(!($("#name").val())) {
    output = false;
    $("#name-error").html("Name required!");
  }
  if(!($("#surname").val())) {
    output = false;
    $("#surname-error").html("Surname required!");
  }
  if(!($("#gender").val())) {
    output = false;
    $("#gender-error").html("Gender is required!");
  }
  if(!($("#state").val())) {
    output = false;
    $("#state-error").html("State is required!");
  }
   if(!($("#local").val())) {
    output = false;
    $("#local-error").html("Local govt is required!");
  }
  if(!($("#phone").val())) {
    output = false;
    $("#phone-error").html("Phone required!");
  }
  
  if(!($("#email").val())) {
    output = false;
    $("#email-error").html("Email required!");
  } 
  if(!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
    $("#email-error").html("Invalid Email!");
    output = false;
  }
}

if($("#password-field").css('display') != 'none') {
  if(!($("#passport").val())) {
    output = false;
    $("#passport-error").html("Passport is required!");
  }
}
if($("#general-field").css('display') != 'none') {
  if(!($("#exam").val())) {
    output = false;
    $("#exam-error").html("Exam type is required!");
  }
  if(!($("#result").val())) {
    output = false;
    $("#result-error").html("O'level Result type is required!");
  }
  if(!($("#jamb").val())) {
    output = false;
    $("#jamb-error").html("Jamb Result type is required!");
  }
}
// if($("#program-field").css('display') != 'none') {
//   if(!($("#program").val())) {
//     output = false;
//     $("#program-error").html("Select program!");
//   }
// }
// if($("#course-field").css('display') != 'none') {
//   if(!($("#course").val())) {
//     output = false;
//     $("#course-error").html("Select course of study!");
//   }
// }
if($("#attest-field").css('display') != 'none') {
  if(!($("#attest").val())) {
    output = false;
    $("#attest-error").html("Kindly tick to agree to our terms and condition before you continue!");
  }
}
return output;
}
$(document).ready(function() {
  $("#next").click(function(){
    var output = validate();
    if(output) {
      var current = $(".active");
      var next = $(".active").next("li");
      if(next.length>0) {
        $("#"+current.attr("id")+"-field").hide();
        $("#"+next.attr("id")+"-field").show();
        $("#back").show();
        $("#finish").hide();
        $(".active").removeClass("active");
        next.addClass("active");
        if($(".active").attr("id") == $("li").last().attr("id")) {
          $("#next").hide();
          $("#finish").show();        
        }
      }
    }
  });
  $("#back").click(function(){ 
    var current = $(".active");
    var prev = $(".active").prev("li");
    if(prev.length>0) {
      $("#"+current.attr("id")+"-field").hide();
      $("#"+prev.attr("id")+"-field").show();
      $("#next").show();
      $("#finish").hide();
      $(".active").removeClass("active");
      prev.addClass("active");
      if($(".active").attr("id") == $("li").first().attr("id")) {
        $("#back").hide();      
      }
    }
  });
});
</script>

<script>
  // $(function(){
  //   $('#signup-form').on('submit',function(e){
  //     e.preventDefault();
  //     var form = $(this).get(0);
  //     console.log(form);
  //   })
  // })
</script>
</head>

<body>
  <div id="main">
    <div id="header">
    <div id="banner">
      <div id="welcome">
        <h2>Gateway Polytechnic,Saapade</h2>
      </div><!--close welcome-->
      <div id="welcome_slogan">
        <h4>Online Admission System</h4>
      </div><!--close welcome_slogan-->
    </div><!--close banner-->
    </div><!--close header-->
    <?php $basename = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);?>
  <div id="menubar">
      <ul id="menu">
        <li <?php if ($basename == 'index') echo ' class="current"'; ?>><a href="index.php">Home</a></li>
        <li <?php if ($basename == 'programmes') echo ' class="current"'; ?>><a href="programmes.php">Programmes</a></li>
        <li <?php if ($basename == 'admissions') echo ' class="current"'; ?>><a href="adGuide.php">Admissions</a></li>
        <li <?php if ($basename == 'signin') echo ' class="current"'; ?>><a href="signin.php">Student Portal</a></li>
        <li <?php if ($basename == 'contact') echo ' class="current"'; ?>><a href="contact.php">Contact Us</a></li>
      </ul>
    </div><!--close menubar-->  
    
  <div id="site_content">   

<?php
  if (isset($_SESSION['user_id'])) {
  echo "<div class=\"sidebar_container\">       
        <div class=\"sidebar\">
        <div class=\"sidebar_item\">
        <h2>Students Dashboard</h2>
        </div><!--close sidebar_item--> 
        </div><!--close sidebar-->";

  $id = $_SESSION['user_id'];
  $query = "SELECT * FROM students WHERE id = {$id}";
  $result = mysql_query($query);
  confirm_query($result);
  $result_set = mysql_fetch_array($result);

  echo "<div class=\"sidebar\">
         <div class=\"sidebar_item\">
         <h4>Welcome  "; 
  echo $result_set['surname']." (".$result_set['ref_number'].")";
  echo "</h4>
         <p><ul>
         <li><a href=\"status.php?sid=";
         echo $_SESSION['user_id'];
         echo "\">Check Admission status</a></li>
         <li><a href=\"application.php?sid=";
          echo $_SESSION['user_id'];
         echo "\">Print Application Form</a></li>
         <li><a href=\"schedule.php?sid=";
          echo $_SESSION['user_id'];
         echo "\">Print Examination Schedule</a></li>
         <li><a href=\"logout.php\">Sign Out</a></li>
         </ul></p>
  </div><!--close sidebar_item-->
  </div><!--close sidebar-->";
  } else {
    echo "<div class=\"sidebar_container\">";
  }
?>
    <div class="sidebar">
      <div class="sidebar_item">
      <h2>Latest Update</h2>
    </div><!--close sidebar_item--> 
    </div><!--close sidebar-->
         <?php
              $page_set = get_all_page();
              while ($page = mysql_fetch_array($page_set)) {
                echo "<div class=\"sidebar\">
                      <div class=\"sidebar_item\">
                      <h3";
                      if($page['id'] == $sel_page) {
                        echo " class=\"selected\"";
                      }
                      
                      echo ">{$page['menu_name']}</h3>
                      <p>{$page['content']}</p>         
                  </div><!--close sidebar_item-->
                </div><!--close sidebar-->";
              }
            ?>
        <div class="sidebar">
          <div class="sidebar_item">
            <h2>Contact</h2>
            <p style="font-size: 10px">Phone: +2348073047104</p>
            <p style="font-size: 10px">Developed by: <a href="facebook.com/createnetworksng">Create Networks NG</a></p>
            <p style="font-size: 10px">Email: <a href="mailto:info@omolewastephen@gmail.com">omolewastephen@gmail.com</a></p>
          </div><!--close sidebar_item--> 
        </div><!--close sidebar-->
       </div><!--close sidebar_container-->

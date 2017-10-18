<?php require_once ("includes/session.php");?>
<?php require_once ("includes/connection.php");?>
<?php require_once ("includes/functions.php");?>
<?php
  $sid = $_GET['sid'];
  $std = getstd($sid);

  $surname = strtoupper($std['surname']);
  $name = $std['name'];
  $jambreg = $std['jambreg'];
  $email = $std['email'];
  $phone = $std['phone'];
  $gender = $std['gender'];
  $address = $std['h_address'];
  $passport = $std['passport'];
  $local = $std['local'];
  $state_id = $std['state_id'];

  $lc = getlocal($local);

  $lcname = $lc['local_name'];

  $sn = getstate($state_id);

  $sname = $sn['name'];



?>
<head>
  <title>Gateway Polytechnic,Ogun State</title>
  <meta name="description" content="website" />
  <meta name="keywords" content="enter your keywords here" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<style type="text/css">
	h1{
		font-family: arial;
		font-size: 40px;
		float: right;
		margin-right: 10%;
		width: 60%;
	}
	h1 >small{
        font-size: 14px;
        font-weight: bold;
        color: black;
	}
	.wrap{
		width: 100%;
		height: 150px;
		color: black
	}
	.wrap> .img{
		float: left;
        width: 30%;
	}
	h4{
      text-decoration: underline;
	}
	table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
	
</style>
</head>

<body>
  <center>
	<div class="container" style="height: 100%;">
		<div class="wrap">
			<div class="img">
			<img src="images/gatewaypic.png" width="100" height="100" style="margin-top: 2%">
		   </div>
	        <h1>Gateway Polytechnic,Saapade<br>
	        	<small>Saapade, Ogun State</small>
	         </h1>  
        </div>
        <div style="clear: both"></div>
        <h4>Application Form</h4>
        <div class="row">
        	<div class="col-md-8">
        		<h4>Bio-Data</h4>
        		<table style="width:50%">
				  <tr>
				    <th>Name:</th>
				    <td><?php echo $surname.","." ".$name; ?></td>
				  </tr>
				  <tr>
				    <th rowspan="1">Jamb Reg. No:</th>
				    <td><?php echo $jambreg; ?></td>
				  </tr>
				   <tr>
				    <th rowspan="1">Email:</th>
				    <td><?php echo $email; ?></td>
				  </tr>
				   <tr>
				    <th rowspan="1">GSM No:</th>
				    <td><?php echo $phone; ?></td>
				  </tr>
				   <tr>
				    <th rowspan="1">Gender:</th>
				    <td><?php echo $gender; ?></td>
				  </tr>
				  <tr>
				    <th rowspan="1">State:</th>
				    <td><?php echo $sname; ?></td>
				  </tr>
				  <tr>
				    <th rowspan="1">Local Govt:</th>
				    <td><?php echo $lcname; ?></td>
				  </tr>
				</table>
        	</div>
        	<div class="col-md-3 col-md-offset-1">
        		<h4>GTP 2017/2018</h4>
        		<img src="<?php echo $passport; ?>" width="120px" height="100px" class="img img-responsive thumbnail">
        	</div>
        </div>
    </div>
   </center>
</body>
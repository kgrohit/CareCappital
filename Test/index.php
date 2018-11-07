<!DOCTYPE html>
<html>
<head>
	<title>Care Cappital Charts</title>
	<!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">-->
	<link rel='stylesheet' href='../main.css' >
	<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js'></script>

</head>
<body>


<div id='content'>

	
	
	
	<?php include "../header.php"; ?>


	<H3>Client Charts</H3>
	
	
	
	
	


	
	
	<div id='save_status'>
		
		<div class="panel-body">
			<h3>Chart Options</h3>
			
			<div style='display: inline-block' >
			<label> Client ID: <br>
 			<input type='text' id='ClientID' value='57' />
			</label>
			</div>
			
			<!-- Datepickers -->
			<div style='display: inline-block' >
			<label> Date 1: <br>
			<input type='text'  id='Date1' value="2015-11-30"  />
			</label>
			</div>
			
			<div style='display: inline-block' >
			<label> Date 2: <br>
			<input type='text'  id='Date2'  value="<?php echo date('Y-m-d'); ?>"  />
			</label>
			</div>
			
			<div style='display: inline-block' >
			<label> Biomarker: <br>
			<select id='bio-select' required >
				<option value='' >Select Biomarker...</option>
				<option value='1' >Systolic</option>
				<option value='2' >Diastolic</option>
				<option value='3' >Weight</option>
				<option value='4' >Pulse</option>
				<option value='5' >Oxygen Saturation</option>
				<option value='6' >Glucose</option>
				<option value='7' >Temperature</option>
				<option value='8' >Peak Flow</option>
				<option value='9' selected >Custom Question 1</option>
				<option value='10' >Custom Question 2</option>
			</select>
			</label>
			</div>
			
			<br><br>
			
			<input class='btn btn-default' id='btn-chart' type='button' value='Create Chart' />
			<input class='btn btn-danger' id='btn-clear' type='button' value='Clear' />
		</div>
		
		<div id='chart-container'><canvas id="myChart" ></canvas></div>
	</div>
	  
	




</div>




<script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


<script src='js/main.js'></script>
</body>
</html>

<!--<?php 
/*
	// get the db. the ".." means that the file is in the previous folder.
	require("../init.php");
	session_start();
	
	
	// At the top of the page we check to see whether the user is logged in or not using the session variable
	if(empty($_SESSION['user'])){
		header("Location: http://www.thesaigroup.org/wp-admin/TeleSystem/index.php");
	}
	
	//check to see if the logout has expired
	if( $_SERVER['REQUEST_TIME'] > $_SESSION['user']['timeout']) {
	    header("Location: ../Account/logout.php");
	}
	
	//refresh the timeout if not
	$_SESSION['user']['timeout'] = $_SERVER['REQUEST_TIME'] + 1800;
	
	
	//same if they lack admin access aka EDIT Role
	if ($_SESSION['user']['Role'] != 'admin1' && $_SESSION['user']['Role'] != 'admin2' ){ 
		header("Location: ../CMS/cms.php");
	}
	
	// Everything below this point in the file is secured by the login system
	// Checked if user was logged in, then if they have been active, and finally if they are an admin1 or admin2
	// Other staff are unable to see this page until they are upgraded

*/
?>-->
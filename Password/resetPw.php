<?php
include '../init.php';


if(isset($_GET['ID']) && isset($_GET['Salt'])) {
	$id = $_GET['ID']; 
	$salt = $_GET['Salt'];
	
	$user = $connection->query("SELECT * FROM UserMaster WHERE AccountID= '". $id. "' AND salt = '". $salt. "'")->fetch();
?>

<head>

<title>Password Reset</title>
<link rel="stylesheet" href="https://www.thesaigroup.org/wp-admin/TeleSystem/main.css" />
<script type='text/javascript' src='password.js'></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	
<style>
	input[type='submit']:disabled  {
		text-decoration: line-through; 
		color: black;
	}
	#password1, #password2 {
		border: 1px solid white;
	}
</style>
</head>
<body>


<div id='wrapper'>
<div id='content'>
<?php include '../header.php'; ?>
<br/><br/>

<br/>			
<div id='save_status'>
	
	<form method="POST" action="passwordReset.php">
	<h1>Password Reset</h1>
	
	<form method='post' action='passwordReset.php'>
	<input type='hidden'  name='AccountID' id='AccountID' value='<?php echo $id; ?>' />
	<input type='password' name='password1' id='password1' placeholder='Enter your password' /><br>
	<input type='password' name='password2' id='password2' placeholder='Re-enter your password' />
	<br>
	<input type='submit' id='resetButton' value='Submit'/>
	</form>
	
	<div id='error'> <br/></div>
	</form>
	
</div>
</div> <!-- Content -->
</div> <!-- wrapper-->

<script>

$("#password1").on('input', function() {
	
	validatePasswords();
});

$("#password2").on('input', function() {
	
	validatePasswords();

});


function validatePasswords() {

	var one = $('#password1').val();
	var two = $('#password2').val();
	
	if( one !== two ) {
		$('#password1').css({"border-color": "#aa3333", 
            		 "border-width":"1px", 
            		 "border-style":"solid"});
            	$('#password2').css({"border-color": "#aa3333", 
            		 "border-width":"1px", 
            		 "border-style":"solid"});
		$('#error').html("Your passwords do not match");
		$('#resetButton').prop('disabled', true);
		
	} else if( one.length < 8) {
		$('#password1').css({"border-color": "#aa3333", 
            		 "border-width":"1px", 
            		 "border-style":"solid"});
            	$('#password2').css({"border-color": "#aa3333", 
            		 "border-width":"1px", 
            		 "border-style":"solid"});
		$('#error').html("Your password is too short.");
		$('#resetButton').prop('disabled', true);
	} else {
		
		$('#resetButton').prop('disabled', false);
		$('#error').html("");
		$('#password1').css({"border": "none"});
		$('#password2').css({"border": "none"});
	}
}

</script>


</body>
	
<?php
	
	
	
} else {
	//if the salt and id werent set redirect to homepage
	header("Location: ../index.php");
}



	
?>
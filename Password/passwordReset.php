<?php 

$id = $_POST['AccountID'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];


if($pw1 != $pw2 ) {
	echo "Passwords do not match.";
} else {


include '../init.php';

$user = $connection->query("SELECT * FROM UserMaster WHERE AccountID = '". $id. "'")->fetch();

$salt = $user['salt'];
$pw1 = $user['pw1'];
$pw2 = $user['pw2'];
$pw3 = $user['pw3'];
$pw4 = $user['pw4'];
$pw5 = $user['pw5'];
$pw6 = $user['pw6'];

//hash the password
$password = hash('sha256', $password1. $salt);

//hash it a bunch of  times for extra protection.
for($round = 0; $round < 65536; $round++) {
	$password = hash('sha256', $password . $salt);
}

// adding the new password in to user1 and shifting the others down a peg. 6 is then deleted.
$pw6 = $pw5;
$pw5 = $pw4;
$pw4 = $pw3;
$pw3 = $pw2;
$pw2 = $pw1;
$pw1 = $password;

$now = $_SERVER['REQUEST_TIME'];
$expire = $now + (60 * 24 * 60 * 60);

$stmt = "UPDATE UserMaster 
	SET pwChange = '$now', pwExpire = '$expire',  pw1 = '$pw1', pw2 = '$pw2', pw3 = '$pw3', pw4 = '$pw4', pw5 = '$pw5', pw6 = '$pw6' 
	WHERE AccountID = '$id' ";
if($connection->prepare($stmt)->execute()){
	//echo "Your new password is: ". $password1. "<br>";
	//echo "Password was successfully reset.<br><a href='../index.php' >Log in</a>";
?>

<head>

<title>Password Reset</title>
<link rel="stylesheet" href="http://www.thesaigroup.org/wp-admin/TeleSystem/main.css" />
<script type='text/javascript' src='password.js'></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	
<style>
	input[type='submit']:disabled  {
		text-decoration: line-through; 
		color: black;
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
	
	<p>Your password has been successfully reset. Please visit the <a href='../index.php' >home</a> page to log back in.</p>
	
	
</div>
</div> <!-- Content -->
</div> <!-- wrapper-->



</body>
<?php
	
	
	
	
}



} //else pw do match
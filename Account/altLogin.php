<?php

//get db
include '../init.php';



//save vars
$email = $_POST['email'];
$id = $_POST['id'];



// find user in db
$prov = $connection->query( "SELECT * FROM ProviderMaster WHERE Email = '$email' AND ProviderID = '$id'");
$client = $connection->query( "SELECT * FROM ClientMaster WHERE Email = '$email' AND ClientID = '$id'");
$care = $connection->query( "SELECT * FROM CaregiverMaster WHERE Email = '$email' AND CaregiverID = '$id'");

if($row = $prov->fetch()) {
	$type = 'Provider';

} elseif ($row = $client->fetch()) {
	$type = 'Client';

} elseif ($row = $care->fetch()) {
	$type = 'Caregiver';

}


if($row){
	//start a session
	session_start();
	
	//since all users using this log in page will be clients/ caregivers / patients, they will get redirected to the CMS
	$_SESSION['client'] = $row;
	$_SESSION['type'] = $type;
	
	header("Location: ../index.php");
	
	
} else {
	echo "Not Found";
}
	

?>
<head>
	<link rel='stylesheet'  href='../main.css' />
</head>
<body>
<div id='wrapper'>

	
	<?php include '../defaultHeader.php'; ?>
	
	<div id='content'>
		<br/><br/>
		<h2>TeleSystem Login</h2>
		<br/><br/>
		
		
		
		<div id='save_status'>
			<form method="POST" action="#" >
				<input type='text' id='email' name='email' placeholder='Email' value="<?php echo $email; ?>"/><br/>
				<input type='password' id='id' name='id' placeholder='Login ID' value="<?php echo $id; ?>"/><br/>
				<input type='submit' value='Login' /><br/><br/>
				<a href="" >
					Forgot your Login Information?
				</a>
			</form>
		</div> <!-- savestatus -->	
	</div> <!-- content -->
	
</div> <!-- wrapper -->

		
		<?php include 'http://www.thesaigroup.org/wp-admin/TeleSystem/footer.php' ?>
		<?php $_ ?>
	
	<!-- END HOME PAGE
	<?php
	
$connection = null;
 ?>


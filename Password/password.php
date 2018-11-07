<?php

include '../init.php'; 

$email =  $_POST['Email'];
echo $email;

/*

//1/20/2017 - Mail test
        require_once "../Mail/PHPMailerAutoload.php";
	$mail = new PHPMailer;
	
	//$mail->isSMTP(); Check out for SPAM emails.
	
//	$mail->Host = 'the.thesaigroup.org:2083';
        $mail->Host = 'the.thesaigroup.org';
	
	$mail->SMTPAuth = true;
	
	$mail->Username = 'saigroup';
	
	$mail->Password = 'M87INvkEHffG';
//	$mail->Password = 'vH609pP9Uqou';
	
	$mail->SMTPSecure = true;
	
	$mail->Port = 465;   // SSL PORT = 465
	//$mail->SMTPDebug=4;
	
	$mail->setFrom('jgreear@americare-health.com', 'Care Cappital');
	$mail->addAddress("kgrohit@yahoo.com","Rohit");
	$mail->isHTML(true);
	
	$mail->Subject = 'Password Reset';
	
	$mail->Body    = "Hello World";
	$mail->AltBody = 'Visit this site to reset your password: http://www.thesaigroup.org/wp-admin/TeleSystem/Password/';
	
	//$mail->UserName = "saigroup";
	//$mail->Password = "M87INvkEHffG";
	
         if(!$mail->send()) {
	   echo 'Message could not be sent.<br>';
	   echo 'Mailer Error: ' . $mail->ErrorInfo;
	   }else{
	   echo "Mail sent successfully";
	   }

//End mail test


*/



$staff_users = $connection->query(
"SELECT * 
FROM StaffMaster
WHERE Email = '". $email. "'" )->fetchAll();

$prov_users = $connection->query(
"SELECT * 
FROM ProviderMaster
WHERE Email = '". $email. "'" )->fetchAll();

$care_users = $connection->query(
"SELECT * 
FROM CaregiverMaster
WHERE Email = '". $email. "'" )->fetchAll();
 
 echo $email. "<hr/>";
 
 

foreach( $staff_users as $user) {

	print_r($user);
	sendEmail($user, 'staff');
	echo "<br><br>";
}
echo "<hr/><hr/>";
foreach( $prov_users as $user) {
	
	print_r($user);
	sendEmail($user, 'prov');
	echo "<br><br>";
}
echo "<hr/><hr/>";
foreach( $care_users as $user) {
	
	print_r($user);
	sendEmail($user, 'care');
	echo "<br><br>";
}


function sendEmail($user, $type) {
	
	include '../init.php';
	
	if($user['StaffID']) { 
		$id = $user['StaffID']; 
	} elseif ($user['ProviderID']) {
		$id = $user['ProviderID']; 
	} elseif ($user['CaregiverID'] ) {
		$id = $user['CaregiverID']; 
	}

	//get id and salt for link
	$info = $connection->query("SELECT AccountID, salt FROM UserMaster WHERE AccountType = '". $type. "' AND TypeID = '". $id. "'")->fetch();
	
	$id = $info['AccountID'];
	
	$salt = $info['salt'];
	
	$link = "http://www.thesaigroup.org/wp-admin/TeleSystem/Password/resetPw.php?ID=$id&Salt=$salt";

	require_once "../Mail/PHPMailerAutoload.php";
	
	$mail = new PHPMailer;
	
//	$mail->isSMTP();
	
//	$mail->Host = 'the.thesaigroup.org:2083';
        $mail->Host = 'the.thesaigroup.org';
	
	$mail->SMTPAuth = true;
	
	$mail->Username = 'saigroup';
	
	$mail->Password = 'M87INvkEHffG';
//	$mail->Password = 'vH609pP9Uqou';
	
	$mail->SMTPSecure = true;
	
	$mail->Port = 465;   // SSL PORT = 465
	$mail->SMTPDebug=4;
	
//	$mail->setFrom('ccrosby@americare-health.com', 'Care Cappital');
	$mail->setFrom('jgreear@americare-health.com', 'Care Cappital');
	$mail->addAddress($user['Email'], $user['FirstName']);
	$mail->isHTML(true);
	
	$mail->Subject = 'Password Reset';
	
	$message = '<html>';
	$message .= "<head><style> tr, th, td { border: none;}</style></head>";
	$message .= '<body>'; 
	$message .= '<table  rules="all" style="width: 100%; border: none;" cellpadding="10">'; 
	$message .= "<tr><td><img src='http://www.thesaigroup.org/wp-admin/TeleSystem/images/care-cappital-logo.png' alt='care cAPPital' /></td></tr>"; 
	$message .= "<tr><td colspan=2>Dear ". $user['FirstName']. 
	",<br /><br />You or our admins have requested a password reset. <br>Please click this <a href='". $link. "' >link</a> to continue.</td></tr>"; 
	$message .= "<tr><td colspan=2 font='colr:#999999;'><I><hr>Care Cappital<br>Stay healthy. </I></td></tr>";  
	$message .= "</table>";
	$message .= "</body></html>";
	$mail->Body    = $message;
	$mail->AltBody = 'Visit this site to reset your password: http://www.thesaigroup.org/wp-admin/TeleSystem/Password/';
	
	if(!$mail->send()) {
	    echo 'Message could not be sent.';
    	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Password Reset</title>
	<link rel="stylesheet" href="http://www.thesaigroup.org/wp-admin/TeleSystem/main.css" />
	<script type='text/javascript' src='password.js'></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
	<div id='wrapper'>
		<div id='content'>
			<?php include '../headerNew.php'; ?>
			<br/><br/>
			
			
			<br/>			
			<div id='save_status'>
				
			<form method="POST" action="password.php">
					<h1>Password Reset</h1>
					
					<p>Message has been sent</p>
			</form>
					
			</div>
		</div> <!-- Content -->
	</div> <!-- wrapper-->
	<?php include '../footer.php'; ?>

</body>
</html>
<?php 
}
	





}

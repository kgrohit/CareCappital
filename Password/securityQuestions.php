<?php
	/*=======================================
	
	
	That email is posted to this page. If the variable Email is posted the sql checks to see if it has a match in the db.
	If there is a match it sents security questions to display through ajax on the same page.
	
	=======================================*/
	
	
if( isset($_POST['Email']) ) {

	include '../init.php'; // get DB

	$email = $_POST['Email']; // save email
	


	$sql = "SELECT StaffMaster.StaffID, UserMaster.AccountID, UserMaster.TypeID, UserSecurity.AccountID, UserSecurity.Security1, UserSecurity.Security2, UserSecurity.Security3 
	        FROM StaffMaster, UserMaster, UserSecurity
	        WHERE StaffMaster.StaffID = UserMaster.TypeID 
	        AND StaffMaster.Email = '$email' 
	        AND UserSecurity.AccountID = UserMaster.AccountID";
		
	$count = 0;
	foreach($connection->query($sql) as $row){
		$user = $row['AccountID'];
		$count++;
	}
	
	
	if($count > 0){
		
	
	require "../Mail/PHPMailerAutoload.php";
	
	$mail = new PHPMailer;
	
	$mail->isSMTP();
	
	$mail->Host = 'thesaigroup.org';
	
	$mail->SMTPAuth = true;
	
	$mail->Username = 'saigroup';
	
	$mail->Password = 'vH609pP9Uqou';
	
	$mail->SMTPSecure = 'tls';
	
	$mail->Port = 25;   // SSL PORT = 465
	
	$mail->setFrom('ccrosby@americare-health.com', 'Mailer');
	$mail->addAddress($email, 'Buddy');
	$mail->isHTML(true);
	
	$mail->Subject = 'Here is the subject';
	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
	    echo 'Message could not be sent.';
    	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo "Message has been sent";
	}
	
	
	}
	
} else {
	return false;
	
	echo "Your email was not set <br/><br/>";
	echo "<input type='button' onclick='goBack()' value='Go Back' >";
		
		
	
}


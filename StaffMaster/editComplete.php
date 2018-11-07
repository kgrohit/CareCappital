<?php

//get the db
include '../init.php';
        
/*
json decode takes the json object we made in js and converts it into an array format. 
call items like $varname['postname']
ie: $staff['first']
*/

$staff= json_decode($_POST['json'],true);





//sql statement split up with line breaks. Easier to read
$sql = "UPDATE StaffMaster SET 
	FirstName = '$staff[first]', 
	MiddleName = '$staff[middle]', 
	LastName = '$staff[last]', 
	DisciplineID = '$staff[disc]', 
	Address1 = '$staff[add1]', 
	Address2 = '$staff[add2]', 
	Address3 = '$staff[add3]', 
	Address4 = '$staff[add4]', 
	City = '$staff[city]', 
	State = '$staff[state]', 
	Zip = '$staff[zip]', 
	County = '$staff[county]', 
	Country = '$staff[country]', 
	Phone = '$staff[phone]', 
	Fax = '$staff[fax]', 
	Email = '$staff[email]', 
	CommMethod1 = '$staff[com1]', 
	CommMethod2 = '$staff[com2]' 
	WHERE StaffID = '$staff[id]' ";
	
	// prepare and execute statement.
$query = $connection->prepare($sql);
$query->execute();


/* =========================================
	
	NEW
	This is the sql for inputing the data into the usersecurity table
	Here we insert the data for the roles, and security questions
	
 =========================================*/
 
$Account = $connection->query("SELECT * FROM UserMaster WHERE TypeID = '". $staff[id]. "' AND AccountType = 'staff'" )->fetch();

$AccountID = $Account['AccountID'];

 
$security = "UPDATE UserSecurity SET
  	    Role = '$staff[role]',
  	    Security1 = '$staff[security1]',
  	    Security2 = '$staff[security2]',
  	    Security3 = '$staff[security3]'
  	    WHERE AccountID = '$AccountID'
  	    ";
$secureQuery = $connection->prepare($security);
$secureQuery->execute();


if($staff[pwOne] == '' ) {
	
	/*//if the user doesn't want to change their password, this statement goes off
	$userstmt2 = "UPDATE UserMaster SET UserName = '$staff[username]' WHERE TypeID= '$staff[id]' ";
	$userquery2 = $connection->prepare($userstmt2);
	$userquery2->execute();
	*/
	echo "You have successfully updated " . $staff[first] . " " . $staff[last] . "'s information.<br/>"; //success on completion
	print "<input type='button' onclick='searchForm()' value='Go back' >"; 
	
	
} else {  // If the user wants to change the password


	// sql stmt for finding salt and the passwords 1 - 6 and saving them to the user variables. 
	$usersql = "SELECT * FROM UserMaster WHERE StaffID = '$staff[id]' ";
	foreach($connection->query($usersql) as $row) {
		$salt = $row['salt'];
		$pw1 = $row['pw1'];
		$pw2 = $row['pw2'];
		$pw3 = $row['pw3'];
		$pw4 = $row['pw4'];
		$pw5 = $row['pw5'];
		$pw6 = $row['pw6'];
	}
	
	//hash the password
	$password = hash('sha256', $staff[pwOne]. $salt);
	
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
	
	
	//update the rest and execute the command. Fields are now uploaded on the db
	$userstmt = "UPDATE UserMaster SET UserName = '$staff[username]', pwChange = NOW(), pw1 = '$pw1', pw2 = '$pw2', pw3 = '$pw3', pw4 = '$pw4', pw5 = '$pw5', pw6 = '$pw6' WHERE StaffID = '$staff[id]' ";
	$userquery = $connection->prepare($userstmt);
	$userquery->execute();
	
	//construct the mail() parameters
	$to = "coty.crosby@gmail.com";
	
	
	$subject = "Password change.";
	$message = "You have changed your TeleSystem Password It is now: " . $staff[pwOne];
	$headers = 'From: Caretronic coty.crosby@gmail.com' . "\r\n" ;
	$headers .='Reply-To: '. $to . "\r\n" ;
	$headers .='X-Mailer: PHP/' . phpversion();
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "BCC: hidden@example.com\r\n";
	
	
	//Confirmation email on changing passwords.
	if(mail($to, $subject, $message, $headers)){
		echo "You have successfully updated " . $staff[first] . " " . $staff[last] . "'s information.\nAn email has been sent to confirm your password change."; //success on complettion 
	}else{
		echo "Error: Your password wasn't successfuly changed.";
	}
	
} 
	









$connection = null;  //close the db

?>
<?php 
/* ===================================================
	HANDLES ALL THE FUNCTIONS FOR CREATING, DELETING, AND UPDATING USER ACCOUNT INFORMATION.
 =================================================== */



/* ===================================================
	Creates the 8char password using upper, lower, and numbers
 =================================================== */
 	
function generatePassword($length = 8) {
	//Generates a string password
        $possibleChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $pass = '';

        for($i = 0; $i < $length; $i++) {
            $rand = rand(0, strlen($possibleChars) - 1);
            $pass .= substr($possibleChars, $rand, 1);
        }

        return $pass;
}


/* ===================================================
	Generates a username based on the users first and last name.
 =================================================== */
function generateUsername($first, $last){

	require "../init.php"; // get db
	
	$first = strtolower($first);
	$last = strtolower($last);
	
	//concat variables for making a username
	$concat = array('', '.', '_', '-');
	//init user
	$username = "";
	
	//taken bool
	$taken = true;
	
	//for all of the concat arrays
	foreach( $concat as $val){
		// firstname + concat val + lastname
		$username = $first. $val. $last;
		
		//check to user if that is already in the usermaster. 4 People with the same name can be used right now.
		 $sql = $connection->query("SELECT UserName FROM UserMaster WHERE UserName = '$username'")->fetch();
		 
		 // Every iteration check to see if the match doesn't exist. Then set taken to false and break;
		 if(!$sql) {
		 	$taken = false;
		 	break;
		 }
	}
	
	//If taken is still true return false.
	if($taken) {
		return false;
	} else { // or return the username.
		return $username;
	}
	
	
}

/* ===================================================
	Handles the insertion for UserMaster and UserSecurity
	USERMASTER: The ID numbers, account types, usernames, and passwords
	USERSECURITY: The access roles, and security questions
 =================================================== */


function createUser($first, $last, $typeid, $type, $email = "" ) {

	include "../init.php"; //get db
	
	//generate password + username.
	//salt is default password
	$pass = generatePassword();
	$user = generateUsername($first, $last);
	$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
	
	$password = hash('sha256', $pass. $salt);
	//hash it a bunch of  times for extra protection.
	for($round = 0; $round < 65536; $round++)
	{
		$password = hash('sha256', $password . $salt );
	}
	
	
	$now = $_SERVER['REQUEST_TIME'];
	$expire = $now; 
	
	//upload the usermaster data.
	
	// query string for creating usermaster account
	$user_sql = "INSERT INTO UserMaster ( UserName, TypeID, AccountType, pwChange, pwExpire, salt, pw1) VALUES ('$user', '$typeid', '$type','$now', '$expire', '$salt', '$password')"; 
	$user_query = $connection->prepare($user_sql)->execute();
	
	// Grab the last ID we just generated
	$accountID  = $connection->lastInsertId(); 
	
	// Use that ID for a security account linking it together
	$security_sql = "INSERT INTO UserSecurity (AccountID, Role) VALUES ( '$accountID', '$type' )";
	$security_query = $connection->prepare($security_sql);
	$security_query->execute();
	
	$update="Update StaffMaster set AccountID=$accountID where StaffID=$typeid";
        $stmt = $connection->prepare($update);
	$stmt->execute();

	
	//success statement'
	echo "<span id='error'><strong>WRITE THIS DOWN.</strong></span><br/><br/>";
	echo "An account has been created for ". $first. " ". $last. ".<br/>Username:". $user. "<br/>Password: ". $pass;
	
	
	
	//EMAIL HANDLER. On Account creation we should send an email saying the account was created.
	//PASS Password and Username?
	if( $email != "" ) {
	
	
	
	
	
	
		//successfull email sent.
		echo "<br/>An email has been set to ". $email. ".(not really)";
	}
	
	

}

/* ===================================================
	Handles the update function for UserMaster and UserSecurity
 =================================================== */
if($_POST['function']) {
	call_user_func($_POST['function']);
}

function updateUser() {

	include "../init.php";
	
	//decode array
	$json = json_decode($_POST['json'], true);
	
	//print_r($json);
	
	//STAFFMASTER
	if($json[AccountType] == "staff"){
		$update = "UPDATE StaffMaster SET Phone = '$json[Phone]', Fax = '$json[Fax]', Email = '$json[Email]', Address1 = '$json[Address1]', Address2 = '$json[Address2]', 
		Address3 = '$json[Address3]', Address4 = '$json[Address4]', City = '$json[City]', State = '$json[State]', Zip = '$json[Zip]', County = '$json[County]', 
		Country = '$json[Country]' WHERE StaffID = '$json[TypeID]' ";
	}
	
	//CAREGIVERMASTER
	if($json[AccountType] == "care"){
		$update = "UPDATE CaregiverMaster SET Phone = '$json[Phone]', Fax = '$json[Fax]', Email = '$json[Email]', Address1 = '$json[Address1]', Address2 = '$json[Address2]', 
		Address3 = '$json[Address3]', Address4 = '$json[Address4]', City = '$json[City]', State = '$json[State]', Zip = '$json[Zip]', County = '$json[County]', 
		Country = '$json[Country]' WHERE CaregiverID = '$json[TypeID]' ";
	}
	
	//PROVIDERMASTER
	if($json[AccountType] == "prov"){
		$update = "UPDATE ProviderMaster SET Phone = '$json[Phone]', Fax = '$json[Fax]', Email = '$json[Email]', Address1 = '$json[Address1]', Address2 = '$json[Address2]', 
		Address3 = '$json[Address3]', Address4 = '$json[Address4]', City = '$json[City]', State = '$json[State]', Zip = '$json[Zip]', County = '$json[County]', 
		Country = '$json[Country]' WHERE ProviderID = '$json[TypeID]' ";
	}
	
	$stmt = $connection->prepare($update);
	$stmt->execute();
	
	//Update the security questions
	$user = "UPDATE UserSecurity SET Security1 = '$json[Security1]', Security2 = '$json[Security2]', Security3 = '$json[Security3]' WHERE AccountID = '$json[AccountID]' ";
	$stmt = $connection->prepare($user);
	$stmt->execute();
	
	if($json[Password1]) {
		// sql stmt for finding salt and the passwords 1 - 6 and saving them to the user variables. 
		$usersql = "SELECT * FROM UserMaster WHERE AccountID = '$json[AccountID]' ";
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
		$password = hash('sha256', $json[Password1]. $salt);
		
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
		//$expire = $now + 600;
		
		$_SESSION['user']['pwExpire'] = $expire;
		//update the rest and execute the command. Fields are now uploaded on the db
		$userstmt = "UPDATE UserMaster SET pwChange = '$now', pwExpire = '$expire',  pw1 = '$pw1', pw2 = '$pw2', pw3 = '$pw3', pw4 = '$pw4', pw5 = '$pw5', pw6 = '$pw6' 
		WHERE AccountID = '$json[AccountID]' ";
		$userquery = $connection->prepare($userstmt);
		$userquery->execute();
		echo "Password Updated.\n";
		
	}
	
	echo "You have updated your account information.";
	

}

/* ===================================================
	Delete function for UserMaster and UserSecurity.
 =================================================== */

function deleteUser($typeid, $type) {
	//todo delete usermaster and security with matching typeid
		
	include '../init.php';
	
	$row = $connection->query("SELECT AccountID FROM UserMaster WHERE TypeID = '$typeid' AND AccountType = '$type'")->fetch();
	
	echo $row['AccountID'];
	echo "<br/>";
	
	$sql = "DELETE FROM UserMaster WHERE AccountID = '". $row['AccountID']. "' and AccountType = '$type'";
	$query = $connection->prepare($sql);
	$query->execute();
	
	$sql = "DELETE FROM UserSecurity WHERE AccountID = '". $row['AccountID']. "'";
	$query = $connection->prepare($sql);
	$query->execute();
	
	echo "You have successfully deleted a user.";
	     
	$connection = null;	
}
<?php
// Access to the database
include "../init.php";

// Sending caregiver's ID
$id = $_POST["ID"];

// Searching for the caregiver's ID
$care = "SELECT * FROM CaregiverMaster WHERE CaregiverID = '$id'";

/*
// Saving the caregiver's last name and first name
foreach($connection->query($care) as $row) {  
	//$caregiver = $row["LastName"] . ", " . $row["FirstName"];  	original statement - cy 10/7/15
	
	$caregiver = $row["CaregiverID"];
}
*/

// Checking clients with associated caregiver
$client = "SELECT * FROM ClientMaster WHERE PrimaryCareID = '$id' OR SecondCareID = '$id'";
	
// returning 'error statements' hahaha
foreach($connection->query($client) as $row) {  
	echo $row['FirstName'];
}

?>
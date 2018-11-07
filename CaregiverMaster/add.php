<?php

// this is the file that takes all the inputs from the form and uploads them to the database.
include '../init.php'; // get db
$json = json_decode($_POST['json'],true);


	
	


$sql = "INSERT INTO CaregiverMaster (FirstName, MiddleName, LastName, Address1, Address2, Address3, Address4, City, State, Zip, County, Country, Phone, Fax, Email, CommMethod1, 
CommMethod2) VALUES('$json[first]', '$json[middle]', '$json[last]', '$json[address1]', '$json[address2]', '$json[address3]', '$json[address4]', '$json[city]', '$json[state]', '$json[zip]', '$json[county]', '$json[country]', '$json[phone]', '$json[fax]', '$json[email]', '$json[com1]', '$json[com2]' )";

$query = $connection->prepare($sql);

if($query->execute()) {
	$careid = $connection->lastInsertId(); // GRABBING CARE ID
	include "../Account/account.php";
	createUser($json[first], $json[last], $careid, "care", $json[email]);
} else{
	echo '$QUERY FAILED';
}


$connection = null;

	


?>
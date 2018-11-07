<?php

// this file checks to see if a user is already in the db. if nothing comes up then javascript creates a form.

// get db
include '../init.php'; // get db

// save f and l
$first= $_POST['first'];
$last= $_POST['last'];

// search for match
$stmt = "SELECT * FROM ProviderMaster WHERE FirstName = '$first' AND LastName = '$last' ";

foreach ($connection->query($stmt) as $row) {

	// this data is not even printed. If anything gets returned javascript prints out an already entered error. 

	print $row['FirstName'] . " " . $row['LastName'] . " has already been entered in the database."; 
	
}
//close db
$connection = null;	



?>
<?php

// this file checks to see if a user is already in the db. if nothing comes up then javascript creates a form.

if (!empty($_POST["first"]) && !empty($_POST["last"])) {

	// get db
	include '../init.php';
	
	// save f and l
	$first= $_POST['first'];
	$last= $_POST['last'];
	
	// search for match
	$stmt = "SELECT * FROM ClientMaster WHERE FirstName = '$first' AND LastName = '$last' ";
	
	foreach ($connection->query($stmt) as $row) {
	
		// this data is not even printed. If anything gets returned javascript prints out an already entered error. 
	
		print "CareID: " . $row['ClientID'] . "<br/>";
		print "Name: " . $row['FirstName'] . " " . $row['LastName'] . "<br/>";
		print "Phone: " . $row['Phone'] . "<br/>";
		print "Email: " . $row['Email'] . "<br/><br/><br/>";
		
	}
	//close db
	$connection = null;	
	
}else{  
    
}





?>
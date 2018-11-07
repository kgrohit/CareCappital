<?php

// this file checks to see if diagnosis is already in the db. if nothing comes up then javascript creates a form.

	// get db
	include '../init.php';
	
	// save desc
	$desc = $_POST['desc'];
	
	// search for match
	$stmt = "SELECT * FROM MedicalDiagnosis WHERE Description = '$desc'";
	
	foreach ($connection->query($stmt) as $row) {
	
		// this data is not even printed. If anything gets returned javascript prints out an already entered error. 
	
		print "ID: " . $row['ICD'] . "<br/>";
		print "Name: " . $row['Description'] . "<br/>";
	
	/*	comment out this from original - Chia Yang 9/29/15
		print "CareID: " . $row['CaregiverID'] . "<br/>";
		print "Name: " . $row['FirstName'] . " " . $row['LastName'] . "<br/>";
		print "Phone: " . $row['Phone'] . "<br/>";
		print "Email: " . $row['Email'] . "<br/><br/><br/>";
	*/
		
	}
	//close db
	$connection = null;	

?>
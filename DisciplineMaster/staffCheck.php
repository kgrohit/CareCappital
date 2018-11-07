<?php

//Prevents deleting disciplines registered with current staffmembers.


// Access to the database
include "../init.php";

// Sending discipline's ID
$id = $_POST["discID"];

/*
// Searching for the discipline's ID
$descip = "SELECT * FROM DisciplineMaster WHERE DisciplineID = '$id'";

// Saving the discipline ID
foreach($connection->query($descip) as $row) {  
	$discipline = $row["DisciplineID"];
}

*/
// Checking staffs with associated discipline
$staff = "SELECT * FROM StaffMaster WHERE DisciplineID = '$id'";

	
// returning 'error statements' hahaha
foreach($connection->query($staff) as $row) {  
	echo $row['FirstName'];
}	

?>
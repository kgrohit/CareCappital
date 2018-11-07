<?php
/* This code takes a ClientID and deletes all biomarkers for the current day. Then the testrkg file is called to recall that client. */

include '../init.php';

//check to see if a variable was posted.
if(isset($_POST['ClientID'])) {
	
	$sql = "DELETE FROM BiomarkerReadings WHERE ClientID = ". $_POST['ClientID']. " AND DateTimeOfCall = CURDATE()";
	
	$query = $connection->prepare($sql);
	
	if( $query->execute() )  {
		echo "The Clients values have been deleted";
	} else {
		echo "Their was an error deleting the clients values. Please try again later.";
	}
} else {
	echo "Invalid parameters for deletion process.";
	// error statement
}


?>
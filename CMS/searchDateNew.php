<?php 

include '../init.php';
$json = json_decode($_POST['json'],true);//decode json

// new file for the search by date class 
//attempt to optimize the method


/*
	Get all readings for the selected day.
	
	loop through
	
	if the readings ID is new. New line
	else print out a td with the value
	
	
	
	NOTES:
	BIOID of 0 = Missed
	Value = 999999 means the bioreading was initialized and needed but not entered
*/


//call main


$sql = "SELECT * FROM `BiomarkerReadings` WHERE DateTimeOfCall = '$json[select]' ORDER BY ClientID";

$readings = $connection->query($sql)->fetchAll();





$temp = 0;

foreach($readings as $reading) {

	
	echo "<br>";
	
	if( $reading['ClientID'] != $temp) {
		echo "<br><hr/>";
		echo "<h4>". $reading['ClientID']. "</h4>";
	}
	
	if($reading['Value1'] === 0) {
		echo "NO ENTRY";
	} else {
		echo $reading["Value1"];
	}
		
	$temp = $reading['ClientID'];
	
	
}
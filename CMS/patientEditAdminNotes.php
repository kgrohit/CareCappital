<?php 
	//Handles the administration notes that go along with biomarker readings.
	
	include "../init.php";
	
	$json = json_decode($_POST['json'],true);
	
	
	$sql = "UPDATE BiomarkerReadings SET MedicationTaken = '$json[MedicationTaken]', Other = '$json[Other]', InvolvedPersons = '$json[InvolvedPersons]', 
	IfRedCall = '$json[IfRedCall]', Outcome = '$json[Outcome]' WHERE  DateTimeOfCall = '$json[datetime]' AND ClientID = '$json[id]';";
	
	$stmt = $connection->prepare($sql);
	
	$stmt->execute();
	
	echo "UPDATE COMPLETE ";
	
	$connection = null;
	

?>
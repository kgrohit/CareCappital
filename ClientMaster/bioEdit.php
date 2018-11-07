<?php
// this is the file that takes all the inputs from the form and uploads them to the database.
include '../init.php'; // get db



// JS post the json as a 2d array. Call individual elements like $json[1][2] 
// here we could call the elements like $bio[BpSys][normal] 
$bio = json_decode($_POST['json'],true);


$counter = 1; // counts for the BioID. Makes it Semiscalable


//Runs through the arrays inside the json array. Call things with $b['var'] 
foreach($bio as $b) {
	
	// the $bio id variable is the client id. If thats the variable we break out of the loop
	//bio[id] == clientID its at the end of the array here.
	if( $b == $bio[id] ) { 
		break;
	} 
	
	// Thank god I used the 2d for this
	// I named all the individual variables check, normal, high, low, and notes. I can just cycle through all of these and replace that huge block of code.
	$sql = "UPDATE ClientBiomarkerMaster SET 
		isChecked = '" . $b['check'] . "',
		Normal = '" . $b['normal'] . "',
		AlarmHigh = '" . $b['high'] . "',
		AlarmLow = '" . $b['low'] . "',
		Notes = '" . $b['notes'] . "'
		WHERE ClientID = " . $bio[id] . "
		AND BioID = " . $counter;
	
	$query = $connection->prepare($sql);
	
	$query->execute();
	
	$counter++; // inc the counter so it can update the next BioID
	
	
	
	
}

echo "You have successfully updated the clients Biomarkers.";





// OLD INSERT STATEMENT
// Replaced  by forloop
// 
/*

//BP

//sys 
	$sys = "UPDATE ClientBiomarkerMaster  SET 
		isChecked = '$bio[BPSysCheck]',
		Normal = '$bio[BPSysNormal]',
		AlarmHigh = '$bio[BPSysHigh]',
		AlarmLow = '$bio[BPSysLow]',
		Notes = '$bio[BPSysNotes]'  
		WHERE ClientID = '$bio[id]'
		AND BioID = 1 ";
		
	// prepare and execute statement.
	$query1 = $connection->prepare($sys );
	$query1->execute();

//DIA
	$dia = "UPDATE ClientBiomarkerMaster  SET 
		isChecked = '$bio[BPDiaCheck]',
		Normal = '$bio[BPDiaNormal]',
		AlarmHigh = '$bio[BPDiaHigh]',
		AlarmLow = '$bio[BPDiaLow]',
		Notes = '$bio[BPSysNotes]'  
		WHERE ClientID = '$bio[id]'
		AND BioID = 2 ";
		
		// prepare and execute statement.
	$query2 = $connection->prepare($dia);
	$query2->execute();

	
//Weight

	if($bio[lbsCheck] == 'on') { 
		$weight = "lbs";
	} else if ( $bio[kgCheck] == 'on' ) {
		$weight = "kg";
	}
	
	$weight = "UPDATE ClientBiomarkerMaster  SET 
		isChecked = '$bio[WeightCheck]',
		Normal = '$bio[WeightNormal]',
		AlarmHigh = '$bio[WeightHigh]',
		AlarmLow = '$bio[WeightLow]',
		Notes = '$bio[WeightNotes]'
		WHERE ClientID = '$bio[id]'
		AND BioID = 3 ";
		
		// prepare and execute statement.
	$query3 = $connection->prepare($weight);
	$query3->execute();

	
// Pulse Rate


	$pr = "UPDATE ClientBiomarkerMaster  SET 
		isChecked = '$bio[PulseRateCheck]',
		Normal = '$bio[PulseRateNormal]',
		AlarmHigh = '$bio[PulseRateHigh]',
		AlarmLow = '$bio[PulseRateLow]',
		Notes = '$bio[PulseRateNotes]'
		WHERE ClientID = '$bio[id]'
		AND BioID = 4 ";
		
		// prepare and execute statement.
	$query4 = $connection->prepare($pr);
	$query4->execute();
	
	
// Oxygen Saturation

	$os = "UPDATE ClientBiomarkerMaster  SET 
		isChecked = '$bio[OxygenSaturationCheck]',
		Normal = '$bio[OxygenSaturationNormal]',
		AlarmHigh = '$bio[OxygenSaturationHigh]',
		AlarmLow = '$bio[OxygenSaturationLow]',
		Notes = '$bio[OxygenSaturationNotes]'
		WHERE ClientID = '$bio[id]'
		AND BioID = 5 ";
		
		// prepare and execute statement.
	$query5 = $connection->prepare($os);
	$query5->execute();

	
// Blood Sugar

	$bs = "UPDATE ClientBiomarkerMaster  SET 
		isChecked = '$bio[BloodSugarCheck]',
		Normal = '$bio[BloodSugarNormal]',
		AlarmHigh = '$bio[BloodSugarHigh]',
		AlarmLow = '$bio[BloodSugarLow]',
		Notes = '$bio[BloodSugarNotes]'
		WHERE ClientID = '$bio[id]'
		AND BioID = 6 ";
		
		// prepare and execute statement.
	$query6 = $connection->prepare($bs);
	$query6->execute();
		

	
// Temperature


	if($bio[TempF] == 'on') { 
		$temp = "F";
	} else if ( $bio[TempC] == 'on' ) {
		$temp = "C";
	}
	

	$temp = "UPDATE ClientBiomarkerMaster  SET 
		isChecked = '$bio[TemperatureCheck]',
		Normal = '$bio[TemperatureNormal]',
		AlarmHigh = '$bio[TemperatureHigh]',
		AlarmLow = '$bio[TemperatureLow]',
		Notes = '$bio[TemperatureNotes]'
		WHERE ClientID = '$bio[id]'
		AND BioID = 7 ";
		
		// prepare and execute statement.
	$query7 = $connection->prepare($temp );
	$query7->execute();

	
// Peak Flow

	$pf = "UPDATE ClientBiomarkerMaster  SET 
		isChecked = '$bio[PeakFlowCheck]',
		Normal = '$bio[PeakFlowNormal]',
		AlarmHigh = '$bio[PeakFlowHigh]',
		AlarmLow = '$bio[PeakFlowLow]',
		Notes = '$bio[PeakFlowNotes]';
		WHERE ClientID = '$bio[id]'
		AND BioID = 8 ";
		
		// prepare and execute statement.
	$query8 = $connection->prepare($pf);
	$query8->execute();


echo "Updated Client# " . $bio[id] . " biomarkers successfully."
*/
?>
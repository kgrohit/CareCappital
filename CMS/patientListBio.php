<?php 

include '../init.php';

$id = $_POST['id'];

$Date1 = $_POST['Date1'];
$Date2 = $_POST['Date2'];

$client = $connection->query("SELECT * FROM ClientMaster WHERE ClientID = '$id'")->fetch();

//redundant query, needs to be called biomarkermaster
//$bio = $connection->query("SELECT BioID, FormName, UnitOfMeasure FROM BiomarkerMaster ORDER BY BioID")->fetchAll();
$BiomarkerMaster = $connection->query("SELECT * FROM BiomarkerMaster ORDER BY BioID")->fetchAll();

//Display headers
?>	



<table>
<thead>
<tr>
<th  >Date</th>
<th class='thead '>BP</th>
<th class='thead '>Weight</th>
<th class='thead '>Pulse</th>
<th class='thead '>O<sub><sub>2</sub></sub> Sat</th>
<th class='thead '>Glucose</th>
<th class='thead '>Temp</th>
<th class='thead '>PF</th>
<th class='thead '>CQ1</th>
<th class='thead '>CQ2</th>
<th class='thead '>Outcome</th>
</tr>
</thead>
<tbody>

<?php

// Get dates client has entered data 
$dates = $connection->query("SELECT * FROM (SELECT DateTimeOfCall 
FROM BiomarkerReadings 
WHERE ClientID = ". $id. " 
AND DateTimeOfCall >= '$Date1' AND DateTimeOfCall <= '$Date2'
ORDER BY DateTimeOfCall DESC) as t1 GROUP BY DateTimeOfCall DESC")->fetchAll();

foreach( $dates as $date ) {

echo "<tr id='hover' onclick=\"editBio(". $id. ",  '". $date['DateTimeOfCall']. "' )\" >";

echo "<td>". $date['DateTimeOfCall']. "</td>";
	
$Biomarkers = $connection->query(
	  "SELECT BioID, Value1, SkipFlag, Outcome FROM BiomarkerReadings  
	   WHERE ClientID = '". $client['ClientID']. "'  
	   AND DateTimeOfCall = '". $date['DateTimeOfCall']. "'
	   ORDER BY BioID")->fetchAll();
	   
	   
  
//redundant query. Moved up
//$BiomarkerMaster = $connection->query("SELECT * FROM BiomarkerMaster ORDER BY BioID")->fetchAll();



$missedcall = false;
$bpsys = "";
$bpdia = "";
   
foreach( $BiomarkerMaster as $bio) { //cycle through the biomarkers

	

	

//get the value of the biomarker from the reading
foreach( $Biomarkers as $readings) {

	//save the outcome
	$outcome = $readings['Outcome'];
	
	
	
	if($readings['BioID'] == '0') {
		// if the bioid is zero, that means the user missed there call. break out of both loops. 
		$missedcall = true;
		break;
		
	} elseif( $bio['BioID'] == $readings['BioID'] && $readings['SkipFlag'] == 'y'  ) {

		$value = 'skip';
		
	} elseif( $bio['BioID'] == $readings['BioID'] && $readings['Value1'] == 999999 || $readings['Value1'] == 10000 ) {
		//do nothing
		$value = "missed";
	
	}elseif($bio['BioID'] == $readings['BioID'] ) {
	
		if($readings['BioID'] == 1 || $readings['BioID'] == 2 ) {
		  //for BP 
		  if( $readings['BioID'] == 1) {
		  	$bpsys = $readings['Value1'];

		  	break;
		  }
		  
		  if( $readings['BioID'] == 2 ) {
		  	$bpdia = $readings['Value1'];

		  }
		  
		  
		  
		  
	        } else if( $readings['BioID'] == 9 || $readings['BioID'] == 10) {
	           if( $readings['Value1'] == 1) {
	               $value = "Yes";
	           } elseif($readings['Value1'] == 2) {
	               $value = "<span class='high'>No</span>";
	           }
	        
		} else {
		    $value = $readings["Value1"];
		}
		
	} 
	
	
	
	
	
}
// if missed call is true break out of the BiomarkerMaster loop
if( $missedcall ) { break; }


if( $value != 'skip') { //skip the query if the value was skipped
	//get the ranges from ClientBiomarkerMaster
	$range = $connection->query("SELECT * FROM ClientBiomarkerMaster WHERE ClientID = " . $client['ClientID']. " AND BioID = '". $bio['BioID']. "'")->fetch();
	
	if($value > $range['AlarmHigh']){
		$class = " class='high' ";
	} elseif($value < $range['AlarmLow']) {
		$class = " class='low' ";
	}else {
		$class = "";
	}

}


		
//format the bloodpressure
if( $bio['BioID'] == 1 || $bio['BioID'] == 2) {

	//if the bioid is 1-2 and the $bp wasnt set, set it to '--'
	if ($bpsys == "" && $bio['BioID'] == 1 ) { $bpsys = "--"; } 
	if ($bpdia == "" && $bio['BioID'] == 2 ) { $bpdia = "--"; } 
	
	if($bpsys > $range['AlarmHigh'] ){ 
		$class = " style='color: red;' ";
	} elseif($bpsys < $range['AlarmLow']) {
		$class = " style='color:blue;' ";
	}else {
		$class = "";
	}
	
	$bpsys = "<span ". $class. ">". $bpsys. "</span>";
	
	if($bpdia > $range['AlarmHigh']){
		$class = " style='color: red;' ";
	} elseif($bpdia < $range['AlarmLow']) {
		$class = " style='color: blue;' ";
	}else {
		$class = "";
	}
	
	$bpdia = "<span ". $class. ">". $bpdia. "</span>";
	
	
	
	$value = $bpsys. "<br>". $bpdia;
	
	
}




//disable classes if no alarm is set
if($range['AlarmHigh'] == "" && $range['AlarmLow'] == "" ) {
	$class= "";
}







// Display value in td
if( $bio["BioID"] > 1 ) {
//Excludes the BPSYS, Inputs a concatenated BPSys over BPDia in the second iteration

	
	if($value == 'skip') { 
		// Show skipped display
		echo "<td class='skip' >Skipped</td>";
	}elseif ($value == 'missed') {
		// Show 999 error
		echo "<td class='error' >ERROR</td>";
	} elseif($bio['BioID'] == 2) {
		// different display for bioid = 2. no additional class was needed
		echo "<td>". $value. "</td>";
		
	} elseif($value){ // if there is a value
		// else show the value
	 	echo "<td". $class. ">". $value.  "</td>";
		
	}else  { // no value put a placeholder
		echo "<td> -- </td>";
	}
	$value = null;// reset the value variable
	$class = null; //reset the class


} // if bioid > 1
} // Foreach biomarkers ( bio 1-10


if($missedcall) {
	// if a bioid of 0 was present this shows up
	echo "<td class='error' colspan='9' ><strong>The user has missed their phone call.</strong></td>"; 
} 

echo "<td>". $outcome. "</td>";
echo "</tr>";
} // for each date
?>

<tbody>
</table>





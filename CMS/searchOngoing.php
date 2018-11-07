<?php 

include '../init.php';

echo "<h1>Ongoing Cases</h1>";

$readings = $connection->query("SELECT * FROM (SELECT ClientID, BioID, DateTimeOfCall FROM BiomarkerReadings WHERE Outcome = 'Ongoing' ORDER BY DateTimeOfCall DESC) as t1 GROUP BY DateTimeOfCall")->fetchAll();

//get biomarker information for labels and value descriptions
$bio = $connection->query("SELECT BioID, FormName FROM BiomarkerMaster ORDER BY BioID")->fetchAll();

if(count($readings) == 0 ){
	echo "All cases are resolved.<br><br><br>";
} else {
	// else lets create a table with the dates
	echo "<table>";
	$tr = 0;
	
	// heading
	echo "<tr>";
		echo "<th>Date</th>";
		echo "<th>Name</th>";
		echo "<th>Biomarkers</th>";
	echo "</tr>";
	
	
	//cycle through all the dates
	foreach($readings as $reading) {
		
		//get client info
		$client = $connection->query("SELECT FirstName, LastName FROM ClientMaster WHERE ClientID = '". $reading["ClientID"] . "'")->fetch();
		
		//get the values of the readings on the ongoing dates.
		
		
		//start row
		if( $tr % 2 == 0 ) {
			echo "<tr id='hover' class='highlight' onclick=\"SkipToEditBio(". $reading['ClientID']. ", '". $reading['DateTimeOfCall']. "' )\" >";
		} else {
			echo "<tr id='hover' onclick=\"SkipToEditBio(". $reading['ClientID']. ", '". $reading['DateTimeOfCall']. "' )\" >";
		}
		echo "<td>". $reading['DateTimeOfCall']. "</td>";
		echo "<td>". $client['FirstName']. " ". $client['LastName']. "</td>";
		echo "<td>";
		foreach( $bio as $b) {	

			
			$sql = "SELECT Value1, SkipFlag FROM BiomarkerReadings 
			WHERE ClientID = '". $reading["ClientID"]. "' AND 
			DateTimeOfCall = '". $reading['DateTimeOfCall']. "' AND 
			BioID = '". $b['BioID']. "'";
			
			$value = $connection->query($sql)->fetch();
			
			$class = ""; // init and reset the class var.
			if($value) {
			
				$range = $connection->query("Select AlarmHigh, AlarmLow FROM ClientBiomarkerMaster WHERE ClientID = '". $reading['ClientID']. "' AND BioID = '". $b['BioID']. "'")->fetch();
				
				// Determine the class for coloring (HIGH, LOW, or NONE)
				if($value['Value1'] > $range['AlarmHigh']){
					$class = " class='high' ";
				} elseif($value['Value1'] < $range['AlarmLow']) {
					$class = " class='low' ";
				}
			}
			//echo the biomarker
			echo $b['FormName']. ": ";
			if($value['SkipFlag'] == 'y') {
				echo "<span class='skip' >Skipped</span>";
			}elseif ($value['Value1'] == '0' || $value['Value1'] == "" ) {
				echo "--";
			}else {
				echo "<span" . $class. ">". $value['Value1']. "</span>";
			}
			echo "<br/>";
			
			
		}
		echo "</td>";
		//end row
		echo "</tr>";
		$tr++; //increment the table counter
	}
}
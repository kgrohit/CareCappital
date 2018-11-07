<?php

include "../init.php"; //get db




$json = json_decode($_POST['json'],true);//decode json




/*
===================================
	GETTING THE SQL
	
	-Used to match the user up with the appropriate clients.
	-Using account type to compare to clients Prov or CareIDs
	-Staff can see all

===================================
*/

//STAFF SQL

if( $_SESSION['user']['AccountType'] == 'staff'){
	$clients = $connection->query("SELECT * FROM ClientMaster ORDER BY ClientID")->fetchAll();
}


//CAREGIVER SQL
if( $_SESSION['user']['AccountType'] == 'care'){
	$clients = $connection->query("SELECT * FROM ClientMaster 
					WHERE PrimaryCareID = '". $_SESSION['user']['TypeID']. "'
					OR SecondCareID = '". $_SESSION['user']['TypeID']. "'
					ORDER BY ClientID")->fetchAll();
}

// PROVIDER SQL
if( $_SESSION['user']['AccountType'] == 'prov'){
	$clients = $connection->query("SELECT * FROM ClientMaster 
					WHERE PrimaryPhyID = '". $_SESSION['user']['TypeID']. "'
					OR SecondPhyID = '". $_SESSION['user']['TypeID']. "'
					ORDER BY ClientID")->fetchAll();
}




$tr = 0; // tr counter for highlighting. Not needed anymore but breaks if I take it out...



//Get the Current time to check if the client has recieved the call yet. Put here so that it doesn't run every loop.
$current = date('H:i:s', $_SERVER['REQUEST_TIME']);
		
		



/*
===================================

	TABLE HEADERS

===================================
*/
echo "<table id='cms'>
<tr>
<th class='thead'>Name</th>
<th class='thead '>BP</th>

<th class='thead '>Weight</th>
<th class='thead '>Pulse</th>
<th class='thead '>O<sub><sub>2</sub></sub> Sat</th>
<th class='thead '>Glucose</th>
<th class='thead '>Temp</th>
<th class='thead '>PF</th>
<th class='thead '>CQ1</th>
<th class='thead '>CQ2</th>
</tr>"; 


/*
===================================
	
	
	Client loop
	
===================================
*/
			
foreach($clients as $client) {

	/*
	===================================
		
		ClientBiomarkerMaster Check
		-Loops through the client bio marker master to see if any values are checked to be monitored
		-saves custom question strings
	
	===================================
	*/
	
	//get clientbiomarker settings from clientbiomarkermaster
	$BiomarkerSettings = $connection->query("SELECT * FROM ClientBiomarkerMaster WHERE ClientID = ". $client['ClientID']. " ORDER BY BioID")->fetchAll();
	
	// init an isChecked variable
	$isChecked = 0;
	$question1 = "";
	$question2 = "";
	
	//cycle through all of their biomarkersettings 
	foreach($BiomarkerSettings as $bs){
		if($bs['isChecked'] > 0) {
			//if the bool isChecked is active and equals 1, increment the counter
			$isChecked++;
		}
		if($bs['BioID'] == 9){
			$question1 = $bs['Notes'];
		}
		
		if($bs['BioID'] == 10){
			$question2 = $bs['Notes'];
		}
	}
	
	//Sample text to display if user doesn't have questions set
	if( $question1 == "" and $question2 == "" ) { $question1 = "User does not have a custom question set."; }
	
	
	
	
	
	
	//See if the phone call has occurred yet? Might be able to take out..
	$phoneCallTime = strtotime($client['PhoneCallTime']);
	
	
	
	// class variable is used to give table rows a highlight class. Used for having alternating colors on table rows
	//This can be manipulated with css...
	$class = "";
	if($tr % 2 == 0 ){ $class = 'highlight'; }
	
	
	
	/*
	===================================
	
		Check the dates and times
		-if the schedule time is grea
	
	===================================
	*/
	if( $phoneCallTime >= $current && $json[select] == date('Y-m-d', $_SERVER['REQUEST_TIME'])) {
		//if the current time is less than the time the patient recieves the calls, do nothing. ( TODAY ONLY )
		
		//if they have readings though, post it
		if(checkReadings($client, $json[select]) == true ) {
		//if they do have readings
		
		
		
		echo "<tr class='". $class. " hover' onclick=\"editForm(". $client['ClientID']. ")\" 
			title='". $question1. " \n ". $question2. "' >
			<td>". $client['FirstName'] . " ". $client['LastName']. "</td>";
		printReadings($client, $json[select]);
		echo "</tr>";
		
		
		
	}
	} elseif($client['DateProgInit'] > $json[select]) {
		//if the selected date is  prior to when the patient was in the system, do nothing
	} elseif ( checkReadings($client, $json[select]) == false && $isChecked > 0  ) {
	
		//Removed this 
		//Only because it was showing up when We were getting null values for entries.
		//I think it might be outdated because we input 999999 values for all phone calls and bio-id 0 values
		
		//Only displays when user does not have anything present for this day meaning that they weren't expecting a phone call
		
		/*
		echo "<tr class='". $class. " hover' onclick=\"editForm(". $client['ClientID']. ")\" >
			<td>". $client['FirstName'] . " ". $client['LastName']. "</td>
			<td colspan='10'>User did not enter biomarkers on this date.</td>
			</tr>";
		*/
		
	}  elseif(checkReadings($client, $json[select]) == true ) {
		/*
		===================================
		
			The main portion of the loop. 
			If the user has readings, start a row and run the print readings function.
		
		===================================
		*/		
		
		echo "<tr class='". $class. " hover' onclick=\"editForm(". $client['ClientID']. ")\" 
			title='Custom Question 1: \n". $question1. "\n\nCustom Question 2: \n ". $question2. "' >
			<td>". $client['FirstName'] . " ". $client['LastName']. "</td>";
		printReadings($client, $json[select]);
		echo "</tr>";
		
		
		
	}
	
	//reset the questions and increment the counter
	$tr++;
	$question1="";
	$question2='';
	
	
}
echo "</table>";

/*
	=====================================================================
	
	Check readings confirms if a user has readings entered on the selected date
	
	=====================================================================
*/
function checkReadings($client, $date ){

	include "../init.php"; // get db
	
	
	// check if the date is set and update if otherwise.
	if( $date == "" ) {
		$date = date("Y/m/d");
	}
	
	// changed format to include bind param for data sanitation
	$readings = $connection->query(
	  "SELECT * FROM BiomarkerReadings  
	   WHERE ClientID = '". $client['ClientID']. "'  
	   AND DateTimeOfCall = '". $date. "'")->fetchAll();
	   
	/*$sql  = "SELECT ClientID FROM BiomarkerReadings  
	   	 WHERE ClientID = :client 
	         AND DateTimeOfCall = :date";
	         
	$readings = $connection->prepare($sql);
	
	$readings->bindParam(':client', $client, PDO::PARAM_STR);
	$readings->bindParam(':date', $date, PDO::PARAM_STR);
	
	$readings->execute();
	$readings->fetchAll();*/
	
	//echo count($readings) . "<br>";
	
	if(count($readings) >= 1 ) {
		 
		  return true;
	 } 
	 
	 return false;

}

/*
===================================


===================================
*/
function printReadings($client, $date ) {

	include "../init.php"; // get db
	
	
	// check if the date is set and update if otherwise.
	if( $date === "" ) {
		$date = date("Y-m-d");
	}
	
	
	$Biomarkers = $connection->query(
	  "SELECT BioID, Value1, SkipFlag FROM BiomarkerReadings  
	   WHERE ClientID = '". $client['ClientID']. "'  
	   AND DateTimeOfCall = '". $date. "'
	   ORDER BY BioID")->fetchAll();
	   
	   
	  
	   
	$BiomarkerMaster = $connection->query("SELECT * FROM BiomarkerMaster ORDER BY BioID")->fetchAll();
	
	
	
	$missedcall = false;
	$bpsys = "";
	$bpdia = "";
	   
        foreach( $BiomarkerMaster as $bio){ //cycle through the biomarkers
        
        	
        
        	
	  	//get the value of the biomarker from the reading
		foreach( $Biomarkers as $readings) {
		
			
			
			
			
			
			if($readings['BioID'] == '0') {
				// if the bioid is zero, that means the user missed there call. break out of both loops. 
				$missedcall = true;
				break;
				
			} elseif( $bio['BioID'] == $readings['BioID'] && $readings['SkipFlag'] == 'y'  ) {
				echo "<script>console.log('Skip found');</script>";
				$value = 'skip';
				
			} elseif($bio['BioID'] == $readings['BioID'] ) {
			
				if($readings['BioID'] == 1 || $readings['BioID'] == 2 ) {
				  //for BP 
				  if( $readings['BioID'] == 1) {
				  	$bpsys = $readings['Value1'];
					if($bpsys == 999999){
                                          $class = " style='color: red;' ";
                                          $bpsys = "<span ". $class. ">". 'ERROR'. "</span>";
                                         }
				  	break;
				  }
				  
				  if( $readings['BioID'] == 2 ) {
				  	$bpdia = $readings['Value1'];
				  	if($bpdia == 999999){
                                        $class = " style='color: red;' ";
                                        $bpdia = "<span ". $class. ">". 'ERROR'. "</span>";

                                        }
				  }
				  
			} elseif( $bio['BioID'] == $readings['BioID'] && $readings['Value1'] == 999999 || $readings['Value1'] == 10000 ) {
				//do nothing
				$value = "missed";
			
					  
				  
				  
				  
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
		
		
		if( $value != 'skip' && $value != '--') { //skip the query if the value was skipped
			//get the ranges from ClientBiomarkerMaster
			$range = $connection->query("SELECT AlarmHigh, AlarmLow FROM ClientBiomarkerMaster WHERE ClientID = " . $client['ClientID']. " AND BioID = '". $bio['BioID']. "'")->fetch();
			
		
			if($value > $range['AlarmHigh']){
				$class = " class='high' ";
			} elseif($value < $range['AlarmLow']) {
				$class = " class='low' ";
			}else {
				$class = "";
			}
			
		}
		
		
				
		/*
		=================================
		
			Format the blood Pressure
			-BP1 doesn't get printed. Its saved and concatenated with BP two for display purposed
			
		=================================
		*/
		if( $bio['BioID'] == 1 || $bio['BioID'] == 2) {
		
			//if the bioid is 1-2 and the $bp wasnt set, set it to '--'
			if ($bpsys == "" && $bio['BioID'] == 1 ) { $bpsys = "--"; } 
			if ($bpdia == "" && $bio['BioID'] == 2 ) { $bpdia = "--"; } 
			
			if($bpsys > $range['AlarmHigh'] && is_numeric($bpsys)){ 
				$class = " style='color: red;' ";
			} elseif($bpsys < $range['AlarmLow'] && is_numeric($bpsys)) {
				$class = " style='color:blue;' ";
			}else {
				$class = "";
			}
			
			//Finished formated string for the systolic pressure
			$bpsys = "<span ". $class. ">". $bpsys. "</span>";
			
			
			if($bpdia > $range['AlarmHigh'] && is_numeric($bpdia) ){
				$class = " style='color: red;' ";
			} elseif($bpdia < $range['AlarmLow'] && is_numeric($bpdia) ) {
				$class = " style='color: blue;' ";
			}else {
				$class = "";
			}
			
			//Finished formated string for the diastolic pressure ( probably butchered spelling )
			$bpdia = "<span ". $class. ">". $bpdia. "</span>";
			
			
			
			//Concate the two strings.
			$value = $bpsys. "<br>". $bpdia;
			
			
		}
		
		
		
		
		//disable classes if no alarm is set
		if($range['AlarmHigh'] == "" && $range['AlarmLow'] == "" ) {
			$class= "";
		}
		
		
		
		
		
		

		// Bio 1 isn't entered, Its displayed on BioID 2 to display the string together
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


}	
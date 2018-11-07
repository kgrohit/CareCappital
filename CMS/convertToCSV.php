<?php

// get the db
include '../init.php'; 

//convert the file to a csv filetype
//this makes it work like a download
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");
header("Pragma: no-cache");
header("Expires: 0");

//save the id
$id = $_GET['clientid'];
$date1 = $_GET['date1'];
$date2 = $_GET['date2'];



//get the client info and list of biomarkers
$client = $connection->query("SELECT FirstName, LastName, Phone, Address1, City, State, Zip, County, Country FROM ClientMaster WHERE ClientID = ". $id)->fetch();
$BiomarkerMaster = $connection->query("SELECT BioID, FormName From BiomarkerMaster ORDER BY BioID")->fetchAll();






//headings for the file
echo $client['FirstName']. " ". $client['LastName']. ", \n";
echo $client['Address1']. ", ". $client['City']. ", ". $client['State']. ", ". $client['Zip']. ", \n"; 
echo $client['Phone']. ", \n\n";
echo "Date, BP, , Weight, Pulse, O2 Sat, Glucose, Temp, PF, C1, C2, Outcome \n\n\n  ";



$dates = $connection->query("SELECT * FROM 
				(SELECT DateTimeOfCall 
				FROM BiomarkerReadings 
				WHERE ClientID = '". $id. "' 
				AND DateTimeOfCall >= '". $date1. "' 
				AND DateTimeOfCall <= '". $date2. "'
				ORDER BY DateTimeOfCall DESC) 
			    as t1 GROUP BY DateTimeOfCall DESC")->fetchAll();
	
	


foreach( $dates as $date ) {
	
	//echo the date
	echo $date['DateTimeOfCall']. ", ";
	
	
	//Get biomarkers from readings table
	$Biomarkers = $connection->query(
		  "SELECT BioID, Value1, SkipFlag, Outcome FROM BiomarkerReadings  
		   WHERE ClientID = '". $id. "'  
		   AND DateTimeOfCall = '". $date['DateTimeOfCall']. "'
		   ORDER BY BioID")->fetchAll();
		   
		   
	foreach($BiomarkerMaster as $bio) {
	
	
	foreach( $Biomarkers as $readings) {
		
	
		//save the outcome
		$outcome = $readings['Outcome'];
		
		
		
		if($readings['BioID'] === '0') {
			// if the bioid is zero, that means the user missed there call. break out of both loops. 
			$missedcall = true;
			break;
			
		} elseif( $bio['BioID'] === $readings['BioID'] && $readings['SkipFlag'] === 'y'  ) {
	
			$value = 'skip';
			
		} elseif( $bio['BioID'] === $readings['BioID'] && $readings['Value1'] === '999999'  || $readings['Value1'] === '10000' ) {
			//do nothing
			$value = "missed";
		
		}elseif($bio['BioID'] === $readings['BioID'] ) {

		        if( $readings['BioID'] == 9 || $readings['BioID'] == 10) {
		           if( $readings['Value1'] == 1) {
		               $value = "Yes";
		           } elseif($readings['Value1'] == 2) {
		               $value = "No";
		           }
		        
			} else {
			    $value = $readings["Value1"];

			}
		}
			
			
			
			
			
			
	} //readings
	
	
	if($missedcall) {
		//if the missed call was triggered break this loop and fill in the commas
		echo "User, missed, their, phone, call., , , , , ,  ";
		break;
	}
	
	//set the value to --
	if( $value == "") { $value = "--"; }
	
	echo $value. ", ";
	$value = "";
	
	
	}//bio
	
	echo $outcome. "\n";
	
	$missedcall  = false;
		   

} //dates 
	
	
	
	



//close the db
$connection = null;
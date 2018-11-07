<?php
// this is the file that takes all the inputs from the form and uploads them to the database.
include '../init.php'; // get db

$json = json_decode($_POST['json'],true);


if (!empty($json["first"]) && !empty($json["last"])) {
	// grab the variables that have been posted 
	
	$callTime = $json['timeToCall'] . ' ' . $json['ampm'];



	
	
	// massive statement. wow. yikes. I'm afraid to touch this.
	$sql = "INSERT INTO ClientMaster (FirstName, MiddleName, LastName, Address1, Address2, Address3, Address4, City, State, Zip, County, Country, Phone, Fax, Email, DOB, DateProgInit, Gender, PrimaryPhyID, SecondPhyID, PrimaryCareID, SecondCareID, Diagnosis1, Diagnosis2, Diagnosis3, Diagnosis4, StaffID, ClientSchedule, StaffSchedule, Care1Schedule, Care2Schedule, Provider1Schedule, Provider2Schedule, MonitoringStartDate, MonitoringEndDate, PhoneCallFrequency, PhoneCallTime, TimeZone) 
	VALUES(:first, :middle, :last, :address1, :address2, :address3, :address4, :city, :state, :zip, :county, :country, :phone, :fax, :email, :dob, CURDATE(), :gender, :provider1, :provider2, :caregiver1, :caregiver2, :diagnosis1, :diagnosis2, :diagnosis3, :diagnosis4, :StaffID,  :clientSchedule, :staffSchedule, :provider1Schedule, :provider2Schedule, :care1Schedule, :care2Schedule, :startDate, :endDate, :phoneFreq, :timeToCall, :timezone )";
		
	$query = $connection->prepare($sql);
	if($query->execute( 
	array(
		':first'=>$json['first'],
		':middle'=>$json['middle'],
		':last'=>$json['last'],
		':address1'=>$json['address1'],
		':address2'=>$json['address2'],
		':address3'=>$json['address3'],
		':address4'=>$json['address4'],
		':city'=>$json['city'], 
		':state'=>$json['state'], 
		':zip'=>$json['zip'], 
		':county'=>$json['county'], 
		':country'=>$json['country'], 
		':phone'=>$json['phone'], 
		':fax'=>$json['fax'], 
		':email'=>$json['email'], 
		':dob'=>$json['dob'], 
		':gender'=>$json['gender'],  
		':provider1'=>$json['provider1'],  
		':provider2'=>$json['provider2'],  
		':caregiver1'=>$json['caregiver1'],  
		':caregiver2'=>$json['caregiver2'],  
		':diagnosis1'=>$json['diagnosis1'],  
		':diagnosis2'=>$json['diagnosis2'],  
		':diagnosis3'=>$json['diagnosis3'],  
		':diagnosis4'=>$json['diagnosis4'],  
		':StaffID'=>$json['StaffID'],  
		':clientSchedule'=>$json['clientSchedule'],  
		':staffSchedule'=>$json['staffSchedule'],  
		':provider1Schedule'=>$json['provider1Schedule'],
		':provider2Schedule'=>$json['provider2Schedule'], 
		':care1Schedule'=>$json['care1Schedule'],  
		':care2Schedule'=>$json['care2Schedule'],
		':startDate'=>$json['startDate'],
		':endDate'=>$json['endDate'],
		':phoneFreq'=>$json['phoneFreq'],
		':timeToCall'=>$callTime,
		':timezone'=>$json['timezone'],
	)))
	
	{
		// GET CLIENT ID
		$clientID = $connection->lastInsertId();
		echo $clientID . "<br/>";
		echo "You have successfully added " . $first. " " . $last. ". <br/>";
		
		echo "<input type='button' onclick='search()' value='Go back' >";
		
		echo "<input type='button' value='Enter Biomarkers' onclick=\"bioForm(". $clientID. ", '". $json[first]. "', '". $json[last]. "')\" />";
	}
	
	else{
		echo '$QUERY FAILED';
	}
	
	

	// Add a set of biomarkers for the newly made client
	$rowSQL = $connection->query("SELECT * FROM BiomarkerMaster");
	$rowSQL->execute();
	
	foreach( $rowSQL as $bio ) {
		//save the bio id
		$bioID = $bio['BioID'];
		
		$bioSQL = $connection->prepare("INSERT INTO ClientBiomarkerMaster (ClientID, BioID) VALUES (:client, :bio )");
		
		if($bioSQL->execute(array(
			':client'=>$clientID,
			':bio'=>$bioID
		))) { //if execute works
			
		}
	}
		
	
		
	
	
	
	
	$connection = null;
    
}

else{  
    echo "The First and last names must be entered before you can enter a user.";
    
}




?>
<?php
// this is the file that takes all the inputs from the form and uploads them to the database.
include '../init.php'; // get db




$client = json_decode($_POST['json'],true);



// write statement
$sql = "UPDATE ClientMaster 
	SET FirstName = '$client[first]', MiddleName = '$client[middle]', LastName = '$client[last]', Address1 = '$client[address1]', 
	Address2 = '$client[address2]', Address3 = '$client[address3]',	Address4 = '$client[address4]', City = '$client[city]', 
	State = '$client[state]', Zip = '$client[zip]', County = '$client[county]', Country = '$client[country]', 
	Phone = '$client[phone]', Fax = '$client[fax]', Email = '$client[email]', DOB = '$client[dob]', Gender = '$client[gender]', 
	PrimaryPhyID = '$client[provider1]',	SecondPhyID = '$client[provider2]', PrimaryCareID = '$client[caregiver1]', 
	SecondCareID = '$client[caregiver2]', Diagnosis1 = '$client[diagnosis1]', Diagnosis2 = '$client[diagnosis2]', 
	Diagnosis3 = '$client[diagnosis3]', Diagnosis4 = '$client[diagnosis4]', StaffID = '$client[StaffID]', ClientSchedule = '$client[clientSchedule]', 
	StaffSchedule = '$client[staffSchedule]', Provider1Schedule = '$client[provider1Schedule]', Provider2Schedule = '$client[provider2Schedule]', 
	Care1Schedule = '$client[care1Schedule]', Care2Schedule = '$client[care2Schedule]', MonitoringStartDate = '$client[startDate]', 
	MonitoringEndDate = '$client[endDate]', PhoneCallFrequency = '$client[phoneCallFrequency]', PhoneCallTime = '$client[timeToCall]', TimeZone = '$client[timezone]'
	WHERE ClientID = '$client[id]'";

// Prepare statement
$stmt = $connection->prepare($sql);

// execute the query
$stmt->execute();


echo " You have successfully updated " . $client[first] . " " . $client[last] . "'s information.<br/>"; //success on completion 
print "<input type='button' onclick='search()' value='Go back' >";


$connection = null;

	     
	
?>
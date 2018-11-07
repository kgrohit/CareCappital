<?php

// Access to the database
include "../init.php";

// Sending provider's ID
$id = $_POST["ID"];

// Searching for the provider's ID
$prov = "SELECT * FROM ProviderMaster WHERE ProviderID = '$id'";

// Saving the provider's last name and first name
foreach($connection->query($prov) as $row) {  
	$provider = $row["ProviderID"];
}

// Checking clients with associated provider
$client = "SELECT * FROM ClientMaster WHERE PrimaryPhyID = '$provider' OR SecondPhyID = '$provider'";
	
// returning 'error statements' hahaha
foreach($connection->query($client) as $row) {  
	echo $row['FirstName'];
}


?>
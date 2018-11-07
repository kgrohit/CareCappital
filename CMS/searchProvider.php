<?php
	
	$json = json_decode($_POST['json'], true);
	
	call_user_func($json['function']);
	/*
	$sql = "SELECT ProviderID FROM ProviderMaster WHERE FirstName ='$json[FirstName]' OR LastName ='$json[LastName]'";
	$data = $connection->query($sql)->fetchAll();
	
	foreach($data as $d){
	
		$id = $d['ProviderID'];
		
		$stmt = "SELECT ClientID, FirstName, LastName FROM ClientMaster WHERE PrimaryPhyID = '$id' OR SecondPhyID = '$id' ORDER BY LastName";
		$patients = $connection->query($stmt)->fetchAll();
		
		foreach($patients as $p) {
			echo $p['ClientID']. ": ". $p['FirstName']. " ". $p['LastName']. "<br/>";
		}
	
	}*/
	
	function getClients(){
		include "../init.php";// get db
		$json = json_decode($_POST['json'], true); //decode json
		if($json[provider] != ''){ // only display clients with providers.
			$stmt = "SELECT ClientID, FirstName, LastName FROM ClientMaster WHERE PrimaryPhyID = '$json[provider]' OR SecondPhyID = '$json[provider]' ORDER BY LastName";
			$patients = $connection->query($stmt)->fetchAll();
			if( count($patients) === 0) {
				echo "No patients found for that provider.";
			} else {
				echo "<h3>Clients</h3>";
				foreach($patients as $p) {
					echo "<a href='#' onclick=\"editForm(". $p['ClientID']. ")\" >". $p['FirstName']. " ". $p['LastName']. "</a><hr/>";
				}
			}
				
		}
	}
	
	
	
	// Called by the SearchBy Dropdown when selecting provider. Creates a dropdown list of all available providers.
	function getProviders() {
		include '../init.php';
		$providers = $connection->query("SELECT ProviderID, FirstName, LastName FROM ProviderMaster ORDER BY LastName")->fetchAll();
		
		echo "<select id='providers' onchange='search()' >";
		echo "<option value=''>Select...</option>";
		foreach($providers as $p){
			echo "<option value='". $p['ProviderID']. "'>". $p['LastName']. " ". $p['FirstName']. "</option>";
		}
		echo "</select>";
	}

	
	
	
?>
<?php

//grab DB
include '../init.php';


$search = json_decode($_POST['json'],true);
// SEARCH FUNCTIONS TO CHOOSE THE SQL STATMENT

// double null values = search all
if($search[first] == "" && $search[last] == "" ) {
	$sql = "SELECT * FROM ClientMaster ORDER BY LastName" ;
}

//1 null 1 not = search for all with the not null.
if($search[first] != "" && $search[last] == "" ) {
	if( $search[first] == '*' ) {
		$sql = "SELECT * FROM ClientMaster ORDER BY LastName " ;
	} else {	
		$sql = "SELECT * FROM ClientMaster WHERE FirstName = '$search[first]' ORDER BY LastName"  ;
	}
}

if($search[first] == "" && $search[last] != ""  ) {

	if( $search[last] == "*" ) {
		$sql = "SELECT * FROM ClientMaster ORDER BY LastName " ;
	} else {
		$sql = "SELECT * FROM ClientMaster WHERE  LastName = '$search[last]'  ORDER BY LastName " ;
	}
}



//When both values are given, checks for *. If * it works like the two above. Else, it searches for the exact match.
if($search[first] != "" && $search[last] != "" ) {
	if( $search[first] == '*' && $search[last] == '*' ) {
		$sql = "SELECT * FROM ClientMaster ORDER BY LastName " ;
	} else if($search[first] == '*'){
		if($search[last] != "")
			$sql = "SELECT * FROM ClientMaster WHERE LastName = '$search[last]'  ORDER BY LastName " ;
		else
			$sql = "SELECT * FROM ClientMaster ORDER BY LastName " ;
	} else if($search[last] == '*') {
		if ($search[first] != "")
			$sql = "SELECT * FROM ClientMaster WHERE  FirstName = '$search[first]' ORDER BY LastName " ;
		else
			$sql = "SELECT * FROM ClientMaster ORDER BY LastName " ;
	} else{
		$sql = "SELECT * FROM ClientMaster WHERE  FirstName = '$search[first]' AND LastName = '$search[last]'  ORDER BY LastName " ;
	}
}



$patients = $connection->query($sql)->fetchAll();

if( count($patients) === 0) {
	echo "No patients found with that name.";
} else {
	echo "<h3>Clients</h3>";
	
	echo "<table>";
	echo "<tr>";
	echo "<th>Name</th>";
	echo "<th>Phone</th>";
	echo "<th>Email</th>";
	echo "</tr>";
	foreach($patients as $p) {
	
	
	/* -------------- Check to see if the user can see this client -------*/
	if($_SESSION['user']['AccountType'] === 'prov' || $_SESSION['user']['AccountType'] === 'care' ) {
			
			
			//if its a provider
			if($_SESSION['user']['AccountType'] === 'prov' ){
				
				// check to see if the providers registered with the client in question match the account type
				if( $_SESSION['user']['TypeID'] !== $p['PrimaryPhyID'] && 
				    $_SESSION['user']['TypeID'] !== $p['SecondPhyID'] ) {
				    	
				    	
				    	echo "<script>console.log('Patient Skipped');</script>";
				    	// skip the iteration in the for loop and move on to the next reading
					continue;
				}
				
			}
			
			//else if its a caregiver
			if($_SESSION['user']['AccountType'] === 'care' ){
			
				//DID NOT TEST!
	
			
				// check to see if the caregivers registered with the client in question match the account type
				if( $_SESSION['user']['TypeID'] !== $p['PrimaryCareID'] && 
				    $_SESSION['user']['TypeID'] !== $p['SecondCareID'] ) {
				    	echo "<script>console.log('Patient Skipped');</script>";
				    	// skip the iteration in the for loop and move on to the next reading
					continue;
				}

			}
		}
	/* If the client (prov or care) is registered with this patient */
		/*echo "<a href='#' onclick=\"editForm(". $p['ClientID']. ")\" >". $p['FirstName']. " ". $p['LastName']. "</a><hr/>";*/
		echo "<tr id='hover' class='highlight' onclick=\"editForm(". $p['ClientID']. ")\" >";
		echo "<td>". $p['FirstName']. " ". $p['LastName']. "</td>";
		echo "<td>". $p['Phone']. "</td>";
		echo "<td>". $p['Email']. "</td>";
		echo "</tr>";
	}
	
	echo "</table>";
}

$connection = null;
?>
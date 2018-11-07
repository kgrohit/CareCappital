<?php

//include db
include "../init.php";





if($_POST['first'] == '*' || $_POST['first'] == '' ) { 
	$first = ""; 
} else { 
	$first = $_POST['first']; 
}

if($_POST['last'] == '*' || $_POST['last'] == '' ) {
	$last = ""; 
} else {
	$last = $_POST['last']; 
}

// sql
$clients = $connection->query("SELECT * FROM ClientMaster WHERE FirstName like  '%$first%' AND LastName like '%$last%' ORDER BY LastName, FirstName ASC")->fetchAll();




//display each client

echo "<ul id='client-list' class='list-group' >";
foreach($clients as $client) {
	
	echo "<li class='list-group-item' id='". $client['ClientID']. "' >". $client['FirstName']. " ". $client['LastName']. "</li>";

}
echo "</ul>";


?>

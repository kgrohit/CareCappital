<?php

include "../init.php";

$id = $_POST['id'];


$sql = "SELECT ClientID 
	FROM ClientMaster 
	WHERE Diagnosis1 = '$id' 
	OR Diagnosis2 = '$id' 
	OR Diagnosis3 = '$id' 
	OR Diagnosis4 = '$id'";

if( ( $connection->query($sql)->rowCount() ) > 0  ){
	

	echo "<br>A Client is registered with that diagnosis.<br><br><input type='button' value='Go Back' onclick='search()' />";
} else { 

	
	if( $connection->query("DELETE FROM MedicalDiagnosis WHERE ICD = '$id' ") ) {
		echo "You have successfully deleted a diagnosis.<br><br><input type='button' value='Go Back' onclick='search()' />";
	} else {
		echo "There was an error with your request.<br>Please try again later.<br><br><input type='button' value='Go Back' onclick='search()' />";
	}
	
	
}
	
$connection = null;	



$connection = null;	



?>
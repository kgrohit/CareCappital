<?php

include '../init.php';

$staff = json_decode($_POST['json'],true);



$sql = "DELETE FROM StaffMaster WHERE StaffID = :ID;";

$query = $connection->prepare($sql);

if($query->execute( array(
':ID'=>$staff[id] 
)) ) {
	// get the account.php access and call the deleteUser function with the typeid and the table type
	include "../Account/account.php";
	deleteUser($staff[id], 'staff');
} else {
	echo "Error";
}


	
	
	
$connection = null;	



?>
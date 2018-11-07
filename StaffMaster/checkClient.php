<?php

//get db
include '../init.php';

$staff = json_decode($_POST['json'],true);


if ($res = $connection->query("SELECT * From ClientMaster WHERE StaffID = '$staff[id]'")) { // query the sql statement and save it to res 

	// Check the number of rows that match the SELECT statement 
	if ($res->fetchColumn() > 0) { //checking the res fetchcolumn method if a match occurs it prints the error
		echo "A client is registed with that staff.";
	}
}
	



// close db
$connection = null;	



?>
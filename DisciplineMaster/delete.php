<?php

include "../init.php";

//do sql check here 
$ID = $_POST["id"];


if( ( $connection->query("SELECT StaffID FROM StaffMaster WHERE DisciplineID = '$ID'")->rowCount() ) > 0  ){
	

	echo "<br>A Staff member is registered with this discipline.<br><br><input type='button' value='Go Back' onclick='search()' />";
} else { 

	
	if( $connection->query("DELETE FROM DisciplineMaster WHERE DisciplineID = '$ID' ") ) {
		echo "You have successfully deleted a discipline.<br><br><input type='button' value='Go Back' onclick='search()' />";
	} else {
		echo "There was an error with your request.<br>Please try again later.<br><br><input type='button' value='Go Back' onclick='search()' />";
	}
	
	
}
	
$connection = null;	



?>
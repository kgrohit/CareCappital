<?php
// this is the file that takes all the inputs from the form and uploads them to the database.
include '../init.php'; // get db

	

// grab the variables that have been posted 
$desc= $_POST['desc'];




if($connection->query("Insert into DisciplineMaster (Description) VALUES ('$desc')")  ) {
	echo "You have successfully added a new discipline.<br><input type='button' value='Go Back' onclick='search()' /> ";

} else {
	echo "There was an error adding the discipline to the database.";
}

	
$connection = null;
	
	     
	
?>
<?php
// this is the file that takes all the inputs from the form and uploads them to the database.
include '../init.php'; // get db

	

// grab the variables that have been posted 
$desc= $_POST['desc'];


// massive statement. wow. yikes. I'm afraid to touch this.
$sql = "INSERT INTO MedicalDiagnosis ( Description ) VALUES( :desc )";

$query = $connection->prepare($sql);
if($query->execute( 
	array(
		':desc'=>$desc
)))

{
	print "You have added a diagnosis to the database! <br/>";
	print "<input type='button' onclick='search()' value='Go back' >";
}

else{
	echo '$QUERY FAILED';
}

	
$connection = null;
	
	     
	
?>
<?php

include 'init.php';


// this is the file that takes all the inputs from the form and uploads them to the database.
include 'init.php'; // get db


// grab the variables that have been posted 
$input = $_POST['Digits'];


// massive statement. wow. yikes. I'm afraid to touch this.
$sql = "INSERT INTO Test ( Input ) VALUES( :input)";

$query = $connection->prepare($sql);
if($query->execute( 
	array(
		':input'=>$input
))){
	
}else{

}

	
$connection = null;
?>

<Response>
	
	<Say>Your data was successfully recorded.</Say>
	
	<Say>Goodbye.</Say>
            
</Response>

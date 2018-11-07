<?php

include '../init.php'; // get db

$ID = $_POST['ID']; //save post var


// delete the client from the clientmaster table
$sql = "DELETE FROM ClientMaster WHERE ClientID = :ID" ;
$query = $connection->prepare($sql);


//delete the clients biomarkers
$bio = "DELETE FROM ClientBiomarkerMaster WHERE ClientID = '$ID'";
$run_bio = $connection->prepare($bio);

//execute both commands.
if( $query->execute( array(':ID'=>$ID )) && $run_bio->execute() ){
	echo "You have successfully deleted a client.";
}




     
     

     
$connection = null;	


?>
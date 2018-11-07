<?php

include '../init.php';

   $ID = $_POST['ID'];
        $sql = "DELETE FROM CaregiverMaster WHERE CaregiverID= :ID" ;
        
        $query = $connection->prepare($sql);

        if($query->execute( array(':ID'=>$ID ))){
        
        	// get the account.php access and call the deleteUser function with the typeid and the table type
		include "../Account/account.php";
		
		if(deleteUser($ID, 'care')){
        		echo "You have successfully deleted a Caregiver.";
        	}
        
        } else { 
        	echo "Query Failed";
        }

     
     
$connection = null;	



?>
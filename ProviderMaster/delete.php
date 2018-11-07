<?php

include '../init.php';

   $ID = $_POST['ID'];
        $sql = "DELETE FROM ProviderMaster WHERE ProviderID= :ID" ;
        
        $query = $connection->prepare($sql);

        if( $query->execute( array(':ID'=>$ID))){
        	include "../Account/account.php";
		deleteUser($ID, 'prov');
        }

  
     
$connection = null;	



?>
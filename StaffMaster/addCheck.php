<?php

// this file checks to see if a user is already in the db. if nothing comes up then javascript launches the addform.



// get db
include '../init.php';



//CHECK USERNAME
if( isset($_POST['username']) && $_POST['username'] != null ){	 // if its posted, and not null 
		
	$username = $_POST['username']; //save var

	if ($res = $connection->query("SELECT * FROM UserMaster WHERE UserName = '$username'")) { // query the sql statement and save it to res 
	
		// Check the number of rows that match the SELECT statement 
		if ($res->fetchColumn() > 0) { //checking the res fetchcolumn method if a match occurs it prints the error
			echo "Username already exists in our database.<br/>";
		}
	}
	

	
} else { // if the user wassn't set
	echo "Username must be set. <br/>";
}


	
// CHECK EMAIL
if( isset($_POST['email']) && $_POST['email'] != null ) { // if value is posted and not null

	$email = $_POST['email'];
	
	if ($res = $connection->query("SELECT * FROM StaffMaster WHERE Email = '$email'")) {  //run query, save to res
	
		// Check the number of rows that match the SELECT statement 
		if ($res->fetchColumn() > 0) {  // check res->rowcount 
			echo "Email already exists in our database.<br/>"; // print error
		}
	}   

} else { // if val wasn't post or was null
	echo "Email must be set.<br/>";
}


//close db
$connection = null;	



?>
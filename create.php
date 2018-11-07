<?php 
include 'init.php';


$users = $connection->query("SELECT * FROM UserMaster")->fetchAll();

foreach($users as $user) {

/*
	echo "<pre>";
	print_r($user);
	echo "</pre><hr>";
	*/
	
	

	
	$sql = "INSERT INTO UserSecurity (AccountID, Role) VALUES( '". $user['AccountID'] . "', '". $user['AccountType']. "' )";
	
	//echo $sql. "<hr/>";
	
	
	$run = $connection->prepare($sql);
	//$run = $run->prepare();
	
	if($run->execute()) {
		echo "IT WORKED";
	}
	
	
		
	
	
}
<?php

include '../init.php'; // get db

	

	// grab the variables that have been posted 
	$first= $_POST['first'];
	$middle= $_POST['middle'];
	$last= $_POST['last'];
	
	$disc= $_POST['disc'];
	
	$address1= $_POST['address1'];
	$address2= $_POST['address2'];
	$address3= $_POST['address3'];
	$address4= $_POST['address4'];
	
	$city= $_POST['city'];
	$state= $_POST['state'];
	$zip= $_POST['zip'];
	$county= $_POST['county'];
	$country= $_POST['country'];
	
	$phone= $_POST['phone'];
	$fax= $_POST['fax'];
	$email= $_POST['email'];
	
	$comm1= $_POST['comm1'];
	$comm2= $_POST['comm2'];
	

// massive statement. wow. yikes. I'm afraid to touch this.
$sql = "INSERT INTO ProviderMaster(FirstName, MiddleName, LastName, DisciplineID, Address1, Address2, Address3, Address4, City, State, Zip, County, Country, Phone, Fax, Email, CommMethod1, CommMethod2) VALUES(:first, :middle, :last, :disc, :address1, :address2, :address3, :address4, :city, :state, :zip, :county, :country, :phone, :fax, :email, :comm1, :comm2 )";
$query = $connection->prepare($sql);

if($query->execute( 

	array(
	':first'=>$first,
	':middle'=>$middle,
	':last'=>$last,
	
	':disc'=>$disc,
	
	':address1'=>$address1,
	':address2'=>$address2,
	':address3'=>$address3,
	':address4'=>$address4,
	
	':city'=>$city,
	':state'=>$state,
	':zip'=>$zip,
	':county'=>$county,
	':country'=>$country,
	
	':phone'=>$phone,
	':fax'=>$fax,
	':email'=>$email,
	':comm1'=>$comm1,
	':comm2'=>$comm2, 
))){
	$provid = $connection->lastInsertId(); // GRABBING CARE ID
	include "../Account/account.php";
	createUser($first, $last, $provid, "prov", $email);
	echo "<br/>";
	print "<input type='button' onclick='searchForm()' value='Go back' >";
	
} else {
	echo '$QUERY FAILED';
}

	
$connection = null;

	

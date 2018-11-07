<?php

//get the db
include '../init.php';  // get db
        
/* Alt method, cy - 11/23/15
// get variables
$id= $_POST['care'];
$first = $_POST['first'];
$middle= $_POST['middle'];
$last = $_POST['last'];
$address1= $_POST['add1'];
$address2= $_POST['add2'];
$address3= $_POST['add3'];
$address4= $_POST['add4'];
$city= $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$county = $_POST['county'];
$country = $_POST['country'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$com1= $_POST['com1']; 
$com2= $_POST['com2'];


// statement
$sql = "UPDATE CaregiverMaster SET FirstName= :first, MiddleName= :middle, LastName= :last, Address1= :address1, Address2= :address2, Address3= :address3, Address4= :address4, City= :city, State= :state, Zip= :zip, County= :county, Country= :country, Phone= :phone, Fax= :fax, Email= :email, CommMethod1= :com1, CommMethod2= :com2 WHERE CaregiverID = :id "; 


$query = $connection->prepare($sql);

$query->execute( array( //assign the placeholders to the variables
':id'=>$id,
':first'=>$first,
':middle'=>$middle,
':last'=>$last,
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
':com1'=>$com1,
':com2'=>$com2, 

));

echo "You have successfully updated " . $first . " " . $last . "'s information.<br/>"; //success on completion 
print "<input type='button' onclick='searchForm()' value='Go back' >";


$connection = null;  //close the db

?>
*/



$data = json_decode($_POST['json'],true);




//sql statement split up with line breaks. Easier to read
$sql = "UPDATE CaregiverMaster SET 
	FirstName = '$data[first]', 
	MiddleName = '$data[middle]', 
	LastName = '$data[last]', 
	Address1 = '$data[add1]', 
	Address2 = '$data[add2]', 
	Address3 = '$data[add3]', 
	Address4 = '$data[add4]', 
	City = '$data[city]', 
	State = '$data[state]', 
	Zip = '$data[zip]', 
	County = '$data[county]', 
	Country = '$data[country]', 
	Phone = '$data[phone]', 
	Fax = '$data[fax]', 
	Email = '$data[email]', 
	CommMethod1 = '$data[com1]', 
	CommMethod2 = '$data[com2]' 
	WHERE CaregiverID = '$data[id]' ";
	
// prepare and execute statement.
//$query = $connection->prepare($sql);
//$query->execute();


// Prepare statement
$stmt = $connection->prepare($sql);

// execute the query
$stmt->execute();


echo " You have successfully updated " . $data[first] . " " . $data[last] . "'s information.<br/>"; //success on completion 
print "<input type='button' onclick='searchForm()' value='Go back' >";


$connection = null;

	     
	
?>

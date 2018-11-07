<?php

//get the db
include '../init.php';
        

// get variables
$id= $_POST['id'];
$first = $_POST['first'];
$middle= $_POST['middle'];
$last = $_POST['last'];
$disc = $_POST['disc'];
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
$sql = "UPDATE ProviderMaster SET FirstName= :first, MiddleName= :middle, LastName= :last, DisciplineID = :disc, Address1= :address1, Address2= :address2, Address3= :address3, Address4= :address4, City= :city, State= :state, Zip= :zip, County= :county, Country= :country, Phone= :phone, Fax= :fax, Email= :email, CommMethod1= :com1, CommMethod2= :com2 WHERE ProviderID= '$id' ";

$query = $connection->prepare($sql);

$query->execute( array( //assign the placeholders to the variables
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
':com1'=>$com1,
':com2'=>$com2,

));

echo "You have successfully updated " . $first . " " . $last . "'s information.<br/>"; //success on complettion 
print "<input type='button' onclick='searchForm()' value='Go back' >";


$connection = null;  //close the db

?>
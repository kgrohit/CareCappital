<?php

include '../init.php'; // get db

$staff = json_decode($_POST['json'],true);
	




// create staff member 
$staff_sql = "INSERT INTO StaffMaster (FirstName, MiddleName, LastName, DisciplineID, Address1, Address2, Address3, Address4, City, State, Zip, County, Country, Phone, Fax, Email, CommMethod1, CommMethod2) VALUES('$staff[first]', '$staff[middle]', '$staff[last]', '$staff[disc]', '$staff[add1]', '$staff[add2]', '$staff[add3]', '$staff[add4]', '$staff[city]', '$staff[state]', '$staff[zip]', '$staff[county]', '$staff[country]', '$staff[phone]', '$staff[fax]', '$staff[email]', '$staff[com1]', '$staff[com2]' )";
$staff_query = $connection->prepare($staff_sql);
$staff_query->execute();
$staffid  = $connection->lastInsertId(); // GRABBING STAFF ID



//create a user ( First, Last, ID, Type, Email)
include "../Account/account.php";
createUser($staff[first], $staff[last], $staffid, "staff", $staff[email]);



//print navigation buttons
echo "<br/><br/><br/>";
print "<input type='button' onclick='editform(". $staffid. ", '". $staff[first]. "', '". $staff[last]. "')' value='Edit User'>";
print "<input type='button' onclick='addForm()' value='Add User'>";
print "<input type='button' onclick='searchForm()' value='Go back'>";



$connection = null; //close db

?>
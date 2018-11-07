<?php

//get the db
include '../init.php';
        

// get variables
$icd = $_POST['icd'];
$desc = $_POST['desc'];

// statement
$sql = "UPDATE MedicalDiagnosis SET Description= :desc WHERE ICD = :icd ";

$query = $connection->prepare($sql);

$query->execute( array( //assign the placeholders to the variables
':desc'=>$desc,
':icd'=>$icd
));

echo "You have successfully updated the Diagnosis Master"; //success on completion 
echo "<br/><input type='button' onclick='search()' value='Go back' >";


$connection = null;  //close the db

?>
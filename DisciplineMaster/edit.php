<?php

//get the db
include '../init.php';
        

// get variables
$id = $_POST['id'];
$desc = $_POST['desc'];

// statement
$sql = "UPDATE DisciplineMaster SET Description= :desc WHERE DisciplineID= :id  ";

$query = $connection->prepare($sql);

$query->execute( array( //assign the placeholders to the variables
':desc'=>$desc,
':id'=>$id
));

echo "You have successfully updated the Discipline Master"; //success on completion 
echo "<br/><input type='button' onclick='search()' value='Go back' >";


$connection = null;  //close the db

?>
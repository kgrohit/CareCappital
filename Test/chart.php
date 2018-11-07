<?php
  require("../init.php");

  // Needs the clientID, the biomarker you're trying to track, and the time duration
  $client = $_GET['clientid'];
  $bio = $_GET['bio'];  
  $date1 = $_GET['date1'];
  $date2 = $_GET['date2'];
 /* 
  //empty assignment operators in case null values. Returns my answers to c1 from 1130 to now
  if( empty($client) || $client == '' ) {
  	$client = 57;
  }  
  
  if( empty($bio) || $bio == '' ) {
  	$bio = 9;
  } 
  
  if( empty($date1) || $date1 == '' ) {
  	$date1 = '2016-11-30';
  } 
  
  if( empty($date2) || $date2 == '' ) {
  	$date2 = date('Y-m-d');
  } 
  
 */
  //init array to hold values
  $date_and_values = array();
  
  
  //get options
  $title = "";
  $low = "";
  $high = "";
  
  $title = $connection->query("SELECT FormName FROM BiomarkerMaster WHERE BioID = '$bio'")->fetch();
  $low = $connection->query("SELECT AlarmLow FROM ClientBiomarkerMaster WHERE BioID = '$bio' AND ClientID = '$client' ")->fetch();
  $high = $connection->query("SELECT AlarmHigh FROM ClientBiomarkerMaster WHERE BioID = '$bio' AND ClientID = '$client' ")->fetch();
  
  // save options to array
  //title alarm high and low
  $options = array(
  	"title" => $title['FormName'],
  	"low" => $low['AlarmLow'],
  	"high" => $high['AlarmHigh']
  );
  //push the array to the dates and values array
  array_push($date_and_values, $options);

  
  
  //search Biomarker readings
  $sql = "Select Value1, DateTimeOfCall From BiomarkerReadings WHERE ClientID = '$client' AND BioID = '$bio' AND Value1 != '999999' AND DateTimeOfCall <= '$date2' AND DateTimeOfCall >= '$date1' ORDER BY DateTimeOfCall";
  $values = $connection->query($sql)->fetchAll();
  

  
  //add each value to the array
  foreach($values as $value) {
    array_push($date_and_values, $value );
  } 
  
  
  
  //return the array as json. This is what JS gets
  echo json_encode($date_and_values );
 

 
?>
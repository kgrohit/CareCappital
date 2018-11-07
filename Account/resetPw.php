<?php

  include '../init.php'; //get the db
  //include '../Mail/mail.php'; // get the new mail package
  
  
  //save post vars
  $id = $_POST['id'];
  $type = $_POST['type'];
  
  // Get the email from the sql commands, if type = x sql = ...
  if($type == 'staff') {
  	$sql = "SELECT StaffID, FirstName, LastName, Email FROM StaffMaster WHERE StaffID = ". $id;
  }
  
  if($type == 'care') {
  	$sql = "SELECT CaregiverID, FirstName, LastName, Email FROM CaregiverMaster WHERE CaregiverID = ". $id;
  }
  
  if($type == 'prov') {
  	$sql = "SELECT ProviderID, FirstName, LastName, Email FROM ProviderMaster WHERE ProviderID = ". $id;
  }
  
  
  //query the sql, saving all info to data
  $data = $connection->query($sql)->fetch();
  
  
  //structuring the mail client
  $to = $data['Email'];
  
  $message = "The admin has reset your password.";

  // In case any of our lines are larger than 70 characters, we should use wordwrap()
  $message = wordwrap($message, 70, "\r\n");

  // Send
  mail($to, 'My Subject', $message);
  
  echo "The password has been reset.";
  
  
  
  
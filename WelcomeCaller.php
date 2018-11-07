<?php
require_once('/home1/saigroup/public_html/wp-admin/TeleSystem/Twilio/Services/Twilio.php');
require_once('/home1/saigroup/public_html/wp-admin/TeleSystem/init.php');
$client_id=$_GET['id'];

/*DELETE BioID=0  
Put this delete query and the insert query in below the say. 
*/
/*
$delete_sql = "DELETE FROM BiomarkerReadings WHERE ClientID = '". $client_id. "' AND DateTimeOFCall = CURDATE() AND BioID = '0' ";
$delete_query = $connection->prepare($delete_sql);
$delete_query->execute();
*/
$query = $connection->query("Select CompanyName from CompanyMaster");
$row=$query->fetch();
$company=$row['CompanyName'];
/*
$query=$connection->query("Select BioID from ClientBiomarkerMaster where ClientID=$client_id and isChecked=1");
while($row=$query->fetch())
{
  $BioIDVal=$row['BioID'];  
  $addquery="Insert into BiomarkerReadings (ClientID,BioID,DateTimeOfCall,Value1,SkipFlag) VALUES ($client_id, $BioIDVal,NOW(),999999,'n')";
  $result=$connection->query($addquery);
}
*/


$query = $connection->query("Select FirstName from ClientMaster where ClientID=$client_id");
if(!$query) die($conn->error);
$row=$query->fetch();
$url='http://www.thesaigroup.org/wp-admin/TeleSystem/Outbound2.php?id='.$client_id.'&name='.$row['FirstName'];
$response=new Services_Twilio_Twiml();
$gather = $response->gather(array(
                       'action'=>$url,
                       'method'=>'GET',
                        'numDigits'=>'1',
                        'finishOnKey'=>' '
            ));

$say="Hello ".$row['FirstName'].". This is your tele-aide from ".$company." , calling to check on your health status. Please listen carefully to our menu options. Press any key on your phone keypad to continue or hang-up to end this call.";
$gather->say($say);
$gather->pause("10");
print $response;



$query=$connection->query("Select BioID from ClientBiomarkerMaster where ClientID=$client_id and isChecked=1 and BioID not in (Select BioId from BiomarkerReadings where ClientID=$client_id and DateTimeOfCall=CURDATE())");
while($row=$query->fetch())
{
  $BioIDVal=$row['BioID'];  
  $addquery="Insert into BiomarkerReadings (ClientID,BioID,DateTimeOfCall,Value1,SkipFlag) VALUES ($client_id, $BioIDVal,NOW(),999999,'n')";
  $result=$connection->query($addquery);
}


?>
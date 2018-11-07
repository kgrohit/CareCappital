<?php
require_once('/home1/saigroup/public_html/wp-admin/TeleSystem/Twilio/Services/Twilio.php');
require_once('/home1/saigroup/public_html/wp-admin/TeleSystem/init.php');
$client_id=$_GET['id'];
$call='O';

$query ="Delete from BiomarkerReadings where ClientID=$client_id and Value1=10000 and SkipFlag='n'";
$result=$connection->query($query);

/*
$delete_sql = "DELETE FROM BiomarkerReadings WHERE ClientID = '". $client_id. "' AND DateTimeOFCall = CURDATE() AND BioID = '0' ";
$delete_query = $connection->prepare($delete_sql);
$delete_query->execute();
*/

$query=$connection->query("SELECT a.BioID,a.Remarks,c.Notes FROM BiomarkerMaster a, ClientBiomarkerMaster c  where a.BioID not in (select b.BioID from BiomarkerReadings b where b.ClientID=$client_id and b.DateTimeOfCall=CURDATE()and Value1<>999999) and a.BioID=c.BioID and c.ClientID=$client_id and isChecked=1 order by a.BioID");
$response=new Services_Twilio_Twiml();
$gather = $response->gather(array(
                       'action'=>'http://www.thesaigroup.org/wp-admin/TeleSystem/gather_user_input2.php?id='.$client_id.'&call='.$call.'&bioid='.$bioid,
                       'finishOnKey'=>'',
                       'timeout'=>'3',
                       'method'=>'GET'
  ));
  $row=$query->fetch();
  $bioid=$row['BioID'];
  if($bioid>=1 AND $bioid<=8)
  {
    $gather->say($row['Remarks']);      
    $redirect=$response->redirect('http://www.thesaigroup.org/wp-admin/TeleSystem/gather_user_input2.php?id='.$client_id.'&call='.$call.'&bioid='.$bioid);
    print $response;
  }
  elseif($bioid>=9 AND $bioid<=10)
  {
    $gather->say($row['Notes']);      
    $redirect=$response->redirect('http://www.thesaigroup.org/wp-admin/TeleSystem/gather_user_input2.php?id='.$client_id.'&call='.$call.'&bioid='.$bioid);
    print $response;
  }
  else
  {
   $response->say("You have sucessfully entered all Biomarkers. Goodbye. Stay Healthy!!!");
   $response->hangup();
   print $response;
  }
?>
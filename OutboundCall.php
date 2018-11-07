<?php
require_once('/home1/saigroup/public_html/wp-admin/TeleSystem/Twilio/Services/Twilio.php');
require_once('/home1/saigroup/public_html/wp-admin/TeleSystem/init.php');
$client_id=$_GET['id'];
$call='O';
$url='http://www.thesaigroup.org/wp-admin/TeleSystem/gather_user_input.php?id='.$client_id.'&call='.$call;
$query ="delete from BiomarkerReadings where ClientID=$client_id and Value1=10000";
$result=$connection->query($query);

$query=$connection->query("SELECT a.BioID,a.Biomarker FROM BiomarkerMaster a, ClientBiomarkerMaster c  where a.BioID not in (select b.BioID from BiomarkerReadings b where b.ClientID=$client_id and b.DateTimeOfCall=CURDATE()) and a.BioID=c.BioID and c.ClientID=$client_id and isChecked=1 order by a.BioID");
$response=new Services_Twilio_Twiml();
$gather = $response->gather(array(
                       'action'=>$url,
                       'method'=>'GET',
                        'numDigits'=>'1'
  ));
  
while($row=$query->fetch())
{
  $gather->say("Press ".$row['BioID']." to enter ".$row['Biomarker']);
  $gather->pause("10");
}
  $gather->say("Press 9 to Repeat");
  $gather->pause("10");
  $gather->say("Press * to Exit or hangup to end this call");
  $gather->pause("10");
  print $response;
 
?>
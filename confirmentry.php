<?php
require_once('/home1/saigroup/public_html/wp-admin/TeleSystem/Twilio/Services/Twilio.php');
$call='C';
$number=0;
$number=$_REQUEST['Digits'];
$client_id=$_GET['id'];
$bioid=$_GET['bioid'];
if($number==0)
{
  $number=$_GET['number'];
}
if($number=='999999')
{
  $call='S';
  $speak="You chose to skip this entry.  Press 1, to confirm and enter next reading,  Press 2 to re-enter";
}
else
{
  if($bioid==3 || $bioid==7)
   {
     $number=$number/10;
   }
  $speak="You entered $number. Press 1, if this is correct and enter next reading, Press 2 to re-enter";
}
$url='http://www.thesaigroup.org/wp-admin/TeleSystem/gather_user_input2.php?id='.$client_id.'&call='.$call.'&number='.$number.'&bioid='.$bioid;
$response=new Services_Twilio_Twiml();
$gather=$response->gather(array(
                     'action'=>$url,
                     'method'=>'GET',
                     'finishOnKey'=>'%',                     
                     'numDigits'=>'1',
));
$gather->say($speak);
$redirect=$response->redirect('http://www.thesaigroup.org/wp-admin/TeleSystem/gather_user_input2.php?id='.$client_id.'&call='.$call.'&number='.$number.'&bioid='.$bioid);
print $response;

?>

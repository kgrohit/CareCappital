<?php
require_once('/home1/saigroup/public_html/wp-admin/TeleSystem/Twilio/Services/Twilio.php');

$response=new Services_Twilio_Twiml();
$response->say("This call is from S.A.I Group.    Please enter your Biomarker Details");
print $response;

$res = clone $response;
$res->redirect('http://www.thesaigroup.org/wp-admin/TeleSystem/OutboundCall.php');
print $res;
?>
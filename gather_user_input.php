<?php

require_once('/home1/saigroup/public_html/wp-admin/TeleSystem/Twilio/Services/Twilio.php');
require_once('/home1/saigroup/public_html/wp-admin/TeleSystem/init.php');
$client_id=$_GET['id'];
$call=$_GET['call'];
$number=$_GET['number'];
$url='http://www.thesaigroup.org/wp-admin/TeleSystem/confirmentry.php?id='.$client_id;
$digit = isset($_REQUEST['Digits']) ? $_REQUEST['Digits'] : null;

if($digit==0 && $call=='O' && $digit!='*' && $digit!='#')
{
  $url='http://www.thesaigroup.org/wp-admin/TeleSystem/OutboundCall.php?id='.$client_id;
  $response=new Services_Twilio_Twiml();
  $response->say("This is an invalid option. Please try again");
  $response->redirect($url);
  print $response;
}

if($digit==9 && $call=='O')
{
  $url='http://www.thesaigroup.org/wp-admin/TeleSystem/OutboundCall.php?id='.$client_id;
  $response=new Services_Twilio_Twiml();
  $response->redirect($url);
  print $response;
}
if($digit!=9 && $digit!='*' && $call=='O' && $digit!=0 && $digit!='#')
{
  $query=$connection->query("Select BioID from ClientBiomarkerMaster where ClientID=$client_id and BioID=$digit and isChecked=1");
  $row=$query->fetch();  
  if($row['BioID']<1)
   {
     $url='http://www.thesaigroup.org/wp-admin/TeleSystem/OutboundCall.php?id='.$client_id;   
     $response=new Services_Twilio_Twiml();
     $response->say("You entered ".$digit.". This is an invalid option. Please choose another option.");     
     $response->redirect($url);
     print $response;
   }  
  else
  { 
  $query=$connection->query("Select Remarks from BiomarkerMaster where BioID=$digit");
  $remark=$query->fetch();
  $query=$connection->query("Select BioID from BiomarkerReadings where ClientID=$client_id and BioID=$digit and DateTimeOfCall=CURDATE()");
  $row=$query->fetch();  
  if($row['BioID']<1)  
   { 
      $query ="Insert into BiomarkerReadings (ClientID,BioID,DateTimeOfCall,Value1,Value2) VALUES ($client_id, $digit,NOW(),10000,0)";
      $result=$connection->query($query);
      $response=new Services_Twilio_Twiml();
      $gather=$response->gather(array(
                      'action'=>$url,
                      'method'=>'GET'
        ));
       $gather->say($remark['Remarks']);
       print $response;
   }
  else
   {  
     $url='http://www.thesaigroup.org/wp-admin/TeleSystem/OutboundCall.php?id='.$client_id;   
     $response=new Services_Twilio_Twiml();
     $response->say("Option ".$digit." has already being entered for today. Please choose another option.");     
     $response->redirect($url);
     print $response;
   }      
  }
}
if($digit=='*')
{
  $x=0;
  $query=$connection->query("select BioID from ClientBiomarkerMaster  where ClientID=$client_id and isChecked=1 and BioID not in 
                            (Select BioID from BiomarkerReadings  where ClientID=$client_id and DateTimeOfCall=CURDATE())");
  while($row=$query->fetch())
  {
    $BioIDVal=$row['BioID'];  
    $addquery ="Insert into BiomarkerReadings (ClientID,BioID,DateTimeOfCall,Value1,Value2,SkipFlag) VALUES ($client_id, $BioIDVal,NOW(),0,0,'y')";
    $result=$connection->query($addquery);
  }
  $query ="delete from BiomarkerReadings where ClientID=$client_id and Value1=10000";
  $result=$connection->query($query);
  $response=new Services_Twilio_Twiml();
  $response->say("Goodbye. Stay healthy. ");
  $response->hangup();
  print $response;
}


if($digit==1 && $call=='C')
{
  $query=$connection->query("select BioID from BiomarkerReadings where ClientID=$client_id and Value1=10000");
  $row=$query->fetch();
  if($row['BioID']==3 || $row['BioID']==7)
  {
   $number=$number/10;
  }
  $query ="update BiomarkerReadings  set Value1=$number where ClientID=$client_id and Value1=10000";
  $result=$connection->query($query);
  $url='http://www.thesaigroup.org/wp-admin/TeleSystem/OutboundCall.php?id='.$client_id;
  $response=new Services_Twilio_Twiml();
  $gather=$response->gather(array(
                      'action'=>$url,
                      'method'=>'GET',
                      'finishOnKey'=>'%',                      
                      'numDigits'=>'1'
));
  $gather->say("Your number has been submitted. Press any key to enter the next reading.");
  print $response;
}

if($digit==2 && $call=='C')
{
  $response=new Services_Twilio_Twiml();
  $gather=$response->gather(array(
                      'action'=>$url,
                      'method'=>'GET'
));
  $gather->say("Enter the whole number for the bio-marker selected ");
  print $response;
}

if($digit !=2 && $digit !=1 && $digit !='*' && $digit !='#' && $call=='C')
{
  $url='http://www.thesaigroup.org/wp-admin/TeleSystem/confirmentry.php?id='.$client_id.'&number='.$number;
  $response=new Services_Twilio_Twiml();
  $response->say("Invalid Option selected.".$digit);
  $response->redirect($url);
  print $response;
}

?>
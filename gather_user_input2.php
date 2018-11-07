<?php

require_once('/home1/saigroup/public_html/wp-admin/TeleSystem/Twilio/Services/Twilio.php');
require_once('/home1/saigroup/public_html/wp-admin/TeleSystem/init.php');
$client_id=$_GET['id'];

//running delete sequence if user enters data
$delete_sql = "DELETE FROM BiomarkerReadings WHERE ClientID = '". $client_id. "' AND DateTimeOFCall = CURDATE() AND BioID = '0' ";
$delete_query = $connection->prepare($delete_sql);
$delete_query->execute();

$call=$_GET['call'];
$number=$_GET['number'];
$url='http://www.thesaigroup.org/wp-admin/TeleSystem/confirmentry.php?id='.$client_id;
if($call=='O')
{
$query=$connection->query("SELECT a.BioID,a.Biomarker FROM BiomarkerMaster a, ClientBiomarkerMaster c  where a.BioID not in (select b.BioID from BiomarkerReadings b where b.ClientID=$client_id and b.DateTimeOfCall=CURDATE()and Value1<>999999) and a.BioID=c.BioID and c.ClientID=$client_id and isChecked=1 order by a.BioID");
$row=$query->fetch();
 $digit=$row['BioID'];
}
if($call=='C')
{
  $digit = isset($_REQUEST['Digits']) ? $_REQUEST['Digits'] : null;
}
if($call=='S')
{
  $digit = isset($_REQUEST['Digits']) ? $_REQUEST['Digits'] : null;
}

if($number==0)
{
  $number=$_REQUEST['Digits'];
}

if($number==0 && $call=='O' && $number!='*' && $number!='#')
{
  $url='http://www.thesaigroup.org/wp-admin/TeleSystem/Outbound2.php?id='.$client_id;
  $response=new Services_Twilio_Twiml();
  $response->say("You did not enter any value. Press # to skip this biomarker or hang up to end this call");
  $response->redirect($url);
  print $response;
}

if($number==0 && $call=='C' && $number!='*' && $number!='#')
{
  $url='http://www.thesaigroup.org/wp-admin/TeleSystem/confirmentry.php?id='.$client_id.'&number='.$number.'&bioid='.$digit;
  $response=new Services_Twilio_Twiml();
  $response->redirect($url);
  print $response;
}


if($call=='O' && $number=='#')
{
      $url='http://www.thesaigroup.org/wp-admin/TeleSystem/confirmentry.php?id='.$client_id.'&number=999999';
      $query ="update BiomarkerReadings set Value1=10000 where ClientID=$client_id and BioID =$digit and DateTimeOfCall=CURDATE()";
      $result=$connection->query($query);
      $response=new Services_Twilio_Twiml();
      $response->redirect($url);
      print $response;

}


if($call=='O' && $number>0)
{
  $query=$connection->query("Select BioID from ClientBiomarkerMaster where ClientID=$client_id and BioID=$digit and isChecked=1");
  $row=$query->fetch();  
  if($row['BioID']<1)
   {
     $url='http://www.thesaigroup.org/wp-admin/TeleSystem/Outbound2.php?id='.$client_id;   
     $response=new Services_Twilio_Twiml();
     $response->say("You entered ".$digit.". This is an invalid option. Please choose another option.");     
     $response->redirect($url);
     print $response;
   }  
  else
  { 
  $query=$connection->query("Select BioID from BiomarkerReadings where ClientID=$client_id and BioID=$digit and DateTimeOfCall=CURDATE()and Value1<>999999");
  $row=$query->fetch();  
  if($row['BioID']<1)  
   { 
      $url='http://www.thesaigroup.org/wp-admin/TeleSystem/confirmentry.php?id='.$client_id.'&number='.$number.'&bioid='.$digit;
      $query ="update BiomarkerReadings set Value1=10000 where ClientID=$client_id and BioID =$digit and DateTimeOfCall=CURDATE()";
      $result=$connection->query($query);
      $response=new Services_Twilio_Twiml();
      $response->redirect($url);
      print $response;
   }
  else
   {  
     $url='http://www.thesaigroup.org/wp-admin/TeleSystem/Outbound2.php?id='.$client_id;   
     $response=new Services_Twilio_Twiml();
     $response->say("Option ".$digit." has already being entered for today. Please choose another option.");     
     $response->redirect($url);
     print $response;
   }      
  }
}
if(($digit=='*' || $number=='*') && $call=='O')
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
  $response->say("Invalid Option Selected. ");
  $response->redirect('http://www.thesaigroup.org/wp-admin/TeleSystem/Outbound2.php?id='.$client_id);
  print $response;
}


if($digit==1 && $call=='C')
{
  $query=$connection->query("select BioID from BiomarkerReadings where ClientID=$client_id and Value1=10000");
  $row=$query->fetch();
  $query ="update BiomarkerReadings  set Value1=$number,SkipFlag='n' where ClientID=$client_id and Value1=10000";
  $result=$connection->query($query);
  $url='http://www.thesaigroup.org/wp-admin/TeleSystem/Outbound2.php?id='.$client_id;
  $response=new Services_Twilio_Twiml();
  $response->say("Your number has been submitted.");  
  $response->redirect($url);
  print $response;
}

if($digit==1 && $call=='S')
{
  $query ="update BiomarkerReadings  set Value1=0, SkipFlag='y' where ClientID=$client_id and Value1=10000";
  $result=$connection->query($query);
  $url='http://www.thesaigroup.org/wp-admin/TeleSystem/Outbound2.php?id='.$client_id;
  $response=new Services_Twilio_Twiml();
  $response->say("Your entry has been registered.");  
  $response->redirect($url);
  print $response;
}


if($digit==2 && $call=='C')
{
  $bioid=$_GET['bioid'];
  $url='http://www.thesaigroup.org/wp-admin/TeleSystem/confirmentry.php?id='.$client_id.'&bioid='.$bioid;
  $response=new Services_Twilio_Twiml();
  $gather=$response->gather(array(
                      'action'=>$url,
                      'method'=>'GET'
));
  $gather->say("Re-Enter your number for the bio-marker selected ");
  print $response;
}

if($digit==2 && $call=='S')
{
  $response=new Services_Twilio_Twiml();
  $gather=$response->gather(array(
                      'action'=>$url,
                      'finishOnKey'=>'*',
                      'method'=>'GET'
));
  $gather->say("Re-Enter your number for the bio-marker selected ");
  print $response;
}


if($digit !=2 && $digit !=1 && $digit !='*' && $digit !='#' && $call=='C')
{
  $url='http://www.thesaigroup.org/wp-admin/TeleSystem/confirmentry.php?id='.$client_id.'&number='.$number;
  $response=new Services_Twilio_Twiml();
  $response->say("Invalid Option selected.");
  $response->redirect($url);
  print $response;
}

if($digit !=2 && $digit !=1 && $digit !='*' && $digit !='#' && $call=='S')
{
  $url='http://www.thesaigroup.org/wp-admin/TeleSystem/confirmentry.php?id='.$client_id.'&number=999999';
  $response=new Services_Twilio_Twiml();
  $response->say("Invalid Option selected.");
  $response->redirect($url);
  print $response;
}

?>
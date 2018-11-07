<?php
/* script for cron /opt/php55/bin/php /home/saigroup/public_html/wp-admin/TeleSystem/testrkg.php   */
require_once('/home/saigroup/public_html/wp-admin/TeleSystem/Twilio/Services/Twilio.php');
require_once('/home/saigroup/public_html/wp-admin/TeleSystem/init.php');
$version="2010-04-10";
$sid='ACf688c6f95bf0418d458b61a3e26dd26a';
$token='59297d810afd81437e2d26680e8e4a67';
$saiphone="+14193703349";
$client=new Services_Twilio($sid,$token,$version);
/*
$query=$connection->query("select ClientID,Phone, PhoneCallFrequency from ClientMaster where ClientID not in (select ClientID from BiomarkerReadings where DateTimeOfCall=CURDATE()and Bioid<>0 and Value1<>999999)and (curtime()-PhoneCallTime)>=0 and (curtime()-PhoneCallTime)<12000 and PhoneCallFrequency not in ('') and ClientId=52");
*/
$query=$connection->query("select ClientID,Phone, PhoneCallFrequency from ClientMaster where ClientID not in (select ClientID from BiomarkerReadings where DateTimeOfCall=CURDATE()and Bioid<>0 and Value1<>999999) and (date_add(curtime(), interval (TimeZone+5) hour)-PhoneCallTime)>=0 and (date_add(curtime(), interval (TimeZone+5) hour)-PhoneCallTime)<630000 and PhoneCallFrequency not in ('') and ClientID=52 ");


/*  MANUAL CALLS 
    RESETS QUERY TO GET INFO ONLY ON POSTED CLIENT ID
*/
if( isset($_POST['ClientID']) ){
	$query=$connection->query("select ClientID,Phone, PhoneCallFrequency from ClientMaster where  ClientID = ". $_POST['ClientID'] );
}

//get the day of the week. Used in sending calls and BIOID = 0 insert at bottom.
$day = date('N', $_SERVER['REQUEST_TIME']);

echo $day;

while($row=$query->fetch())
{
	$url='http://www.thesaigroup.org/wp-admin/TeleSystem/WelcomeCaller.php?id='.$row['ClientID'];
	
	// array of days client was to be called. IE [1,3,5]
	$days = explode(" ", $row['PhoneCallFrequency'] );
	//if current day is in the list of client days, issue the phone call
	if( in_array($day, $days)) {
		try
		{
		   $call=$client->account->calls->create($saiphone,$row['Phone'],$url);
		   echo 'Started Call: '.$call->sid;
		}catch (Exception $e){
		  echo 'Error: '. $e->getMessage();
		}
		
		
	}


	
}




// Extra sql to find if clients missed the call and insert values. Only on days

$clients = $connection->query("
SELECT ClientID, PhoneCallFrequency
FROM ClientMaster 
WHERE (curtime()-PhoneCallTime)>=300 
AND ClientID in (SELECT ClientID FROM ClientBiomarkerMaster WHERE isChecked = '1')
AND ClientID not in (SELECT ClientID FROM BiomarkerReadings WHERE DateTimeOfCall = CURDATE() ) ")->fetchAll();

foreach($clients as $c) {

	$days = explode(" ", $c['PhoneCallFrequency'] );
	
	if( in_array($day, $days)) {
	
		$sql = $connection->prepare("
		INSERT INTO BiomarkerReadings (ClientID, BioID, DateTimeOfCall, Value1) VALUES (". $c['ClientID']. ", 0, CURDATE(), 0)" );
		$sql->execute();
	}
	
	
}






?>

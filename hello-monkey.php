<?php
$people=array(
"+14196544089"=>"Coty Crosby",
"+15614604422"=>"Rohit Gupta"
);
if(!$name=$people[$_REQUEST['From']])
$name="Monkey";

	header("content-type: text/xml");
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
	<Say>Hello <?php echo $name ?>.</Say>
        <Gather numDigits="1" action="Get-user-input.php" method="POST">
          <Say>To Call Coty, Press 1 </Say>
        </Gather>
</Response>

<?php
	include "../init.php";
		
	$date = $_POST['date'];
	$client = $_POST['client'];
	
	$sql = $connection->query("SELECT * FROM BiomarkerReadings WHERE ClientID = '$client' AND DateTimeOfCall = '$date' ")->fetch();
	
	$bio = $connection->query("SELECT BioID, FormName FROM BiomarkerMaster ORDER BY BioID")->fetchAll();
	

	echo "<div style='text-align: left'>". $date. "</div>";	
?>



	<table>
		<tr>
			<th>Biomarker</th>
			<th>Value</th>
			<th>High</th>
			<th>Low</th>
		</tr>
		
		<tr>
		<?php 
		
		foreach($bio as $b) { // iterate through every biomarker as a value
			// get the range and reading values
		
			//get the ranges
			$range = $connection->query("SELECT AlarmHigh, AlarmLow, Notes FROM ClientBiomarkerMaster WHERE BioID = '". $b['BioID']. "' AND ClientID = '$client'")->fetch();
			
			//get the reading value
			$readings = $connection->query("SELECT BioID, Value1, SkipFlag FROM BiomarkerReadings WHERE ClientID = '$client' AND DateTimeOfCall = '$date' AND BioID = ". $b['BioID'])->fetch();
			
			// ____________________________________
			
			
			//bio td
			echo "<td>". $b['FormName']. "</td>";
		
			//value td 
			echo "<td>";
			if($readings['BioID'] == $b['BioID']) { //if the bio we are sorting through == the reading value ( Needed for '--' output)
		
				if($readings['SkipFlag'] == 'y' ) { //check for skipped value
					echo "<div class='skip' >Skipped</div>";
				} elseif($readings['Value1']==999999){
                                        echo "<div class='skip' >Error</div>";
                                 }  elseif($readings['Value1']) { // Output the value
					echo $readings['Value1']. " ". $range['Notes'];
				}
				
			} else {
				echo "--";
			}
			echo "</td>";
			
			
			
			// high td
			echo "<td>". $range['AlarmHigh']. " ". $range['Notes']. "</td>";
			
			// low td
			echo "<td>". $range['AlarmLow']. " ". $range['Notes']. "</td>";
			
		?>
		 
		  
		  
		</tr>
		
		<?php 
		} 
		
		?>
		
		
	</table>
	
	<h2>Admin Notes</h2>
	<p style='text-align:right; margin-right: 33%;'>
		Medications Taken: <input type='text' id="MedicationsTaken" value="<?php echo $sql['MedicationTaken'] ?>" /> <br/>
		Other: <input type='text' id="Other" value="<?php echo $sql['Other'] ?>" /> <br/>
		Involved Persons: <input type='text' id="InvolvedPersons" value="<?php echo $sql['InvolvedPersons'] ?>" /> <br/>
		If Applicable, called: <input type='text' id="IfRedCall" value="<?php echo $sql['IfRedCall'] ?>" /> <br/>
		<!--Outcome: <input type='text' id="Outcome" value="<?php echo $sql['Outcome'] ?>" /> <br/>-->
		<select id='Outcome'>
			<option value=''>Select...</option>
			<option value='Resolved' <?php if($sql['Outcome'] == 'Resolved') { echo 'selected'; } ?> >Resolved</option>
			<option value='Unresolved' <?php if($sql['Outcome'] == 'Unresolved') { echo 'selected'; } ?> >Unresolved</option>
			<option value='Ongoing' <?php if($sql['Outcome'] == 'Ongoing') { echo 'selected'; } ?> >Ongoing</option>
		</select>
	</p>
	<br/>
	<input type='button' value='Update' onclick="editAdminNotes(<?php echo $client. ", '". $date. "'"; ?>)" />
	<input type='button' value='Cancel' onclick='listBio()' />
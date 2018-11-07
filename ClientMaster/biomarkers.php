<?php
	//get db
	include '../init.php';
	
	$id = $_POST['id'];
	$first = $_POST['first'];
	$last = $_POST['last'];
	
	

?>
<!DOCTYPE html>
<html>
<head>

<link rel='stylesheet' href='http://www.thesaigroup.org/wp-admin/TeleSystem/main.css'>
<style>
	#save_status input[type='text'] {
	  text-align: right;
	}
	
	
</style>

<!-- Scripts to handle weights and things. -->
<script>

$(document).ready(function() {
	// weight handler
	$('#kgCheck').on('change', function() {
		$('.weight').html('kg');
		$('.WeightNotes').html('kg');
	});
	
	$('#lbsCheck').on('change', function() {
		$('.weight').html('lbs');
		$('.WeightNotes').html('lbs');
	});
	
	
	//temp handler
	$('#TempF').on('change', function() {
		$('.temp').html("&deg;F");
		$('#TemperatureNormal').val("98.6");
		$('.TemperatureNotes').html("F");
	});
	
	$('#TempC').on('change', function() {
		$('.temp').html("&deg;C");
		$('#TemperatureNormal').val("37");
		$('.TemperatureNotes').html("C");
	});
	
	//handle bpsys and bpdia
	
	$('#BPSysCheck').on('change', function() {
	
		if( $('#BPSysCheck').prop('checked') === true)  {
			$('#BPDiaCheck').prop('checked', true);
		}
		
		if( $('#BPSysCheck').prop('checked') === false  )  {
			$('#BPDiaCheck').prop('checked', false);
		}



	});
	
	
	
});
		
$('#BPDiaCheck').on('change', function() {

	if( $('#BPDiaCheck').prop('checked') === true)  {
		$('#BPSysCheck').prop('checked', true);
	}
	
	if( $('#BPDiaCheck').prop('checked') === false  )  {
		$('#BPSysCheck').prop('checked', false);
	}
});
	

	
</script>
	
</head>
<body>

<h1>BioMarkers</h1><hr/><br/>
<div id='co2' style='float: right; margin-right: 100px;'> <input type='button' value='Go Back' 
onClick="editform(<?php echo $id . ", '" . $first . "', '" . $last . "'"; ?>)" /> </div> <br/><br/>


<input type='hidden' id="ClientID" value="<?php echo $id ?>" />
<table style="" >
<tr>
	<th>To be monitored</th>
	<th>Normal/Baseline</th>
	<th colspan='2'>Generate alarm, if <br/>
	Higher than // Lower Than
	</th>
	
</tr>



<!-- table loop -->

<?php	

			
	$query = $connection->query("SELECT * FROM ClientBiomarkerMaster WHERE ClientID = '$id';");
	$data = $query->fetchAll();

			
	
	foreach ($data as $d){
		
		if($d['BioID'] == 9 ){ break; }

		
		// Query the bio marker master table for the appropriate biomarker
		$bio = $connection->query("SELECT * FROM BiomarkerMaster WHERE BiomarkerMaster.BioID = " . $d['BioID']);
		$b = $bio->fetch();
		
		$client = $connection->query("SELECT * FROM ClientBiomarkerMaster WHERE ClientID = '$id' AND BioID = " . $d['BioID'] );
		$c = $client->fetch();
		
		
	?>
	
	
		<tr>
			<!-- ________________________CHECK ROWS ________________________-->
			<td>
				<input type='checkbox' id="<?php echo $b['FormName']; ?>Check" name="<?php echo $b['FormName']; ?>Check" 
				<?php if( $d['isChecked']  == 1 ){ echo "checked"; } ?>
				/> 
				<label for="<?php echo $b['FormName']; ?>Check"><?php echo $b['FormName'] ?></label>
				
				<?php 
				
					// weight radio buttons
					if($b['FormName'] == 'Weight' ){ ?>
					
						<span style='margin-left: 25px;'> <br/>
							<!-- radio lbs -->
							<input type='radio' id='lbsCheck' name='radWeight' value="lbs" 
							
							<?php 
								if($d['Notes'] == 'lbs' ) { 
									echo 'checked';
									$weight_notes = 'lbs'; 
								} 
								else if ( $d['Notes'] == '' ) { 
									echo 'checked';
									$weight_notes = 'lbs';
								} 
							?> />
							
							<label for='lbsCheck'>Lbs</label> <br/>
							
							
							<!-- radio kg-->
	      						<input type='radio' id='kgCheck' name='radWeight' value="kg"
	      						
	      						<?php 
	      							if($d['Notes'] == 'kg' ){ 
	      								echo 'checked';
	      								$weight_notes = 'kg';
	      							} 
	      						?> />		
	      						      						
	      						<label for='kgCheck'>Kg</label>
      						</span>
      						
					<?php }
					
					// temp radio buttons
					if($b['FormName'] == 'Temperature' ){ ?>
					
						<span style='margin-left: 25px;'>
						<br />
							<!-- Fahrenheit radio button -->
							<input type='radio' name='Temp' id='TempF' value="F" 
							<?php
								if( $d['Notes'] == 'F' ) {
									echo "checked";
									$temp_notes = "F";
								}
							?> /> 
							<label for='TempF' >F</label> <br />
							
							
							<!-- Celsius radio button -->
	      						<input type='radio' name='Temp' id='TempC' value="C"
	      						<?php
								if( $d['Notes'] == 'C' ) {
									echo "checked";
									$temp_notes = "C";
								}
							?> />  
	      						<label for='TempC' >C</label>
	      					</span>
					<?php }
					
				?>
				<br />
			</td>
			<!-- ________________________NORMAL ROWS ________________________-->
			<td> 
				<input type='text' id="<?php echo $b['FormName']; ?>Normal" value ="<?php echo $c['Normal']; ?>"  /> 
				
				<?php echo $b['UnitOFMeasure']; ?>
				
				<br />
			</td>
			<!-- ________________________HIGH ROWS ________________________-->
			<td >
				<input type='text' id="<?php echo $b['FormName']; ?>High" value ="<?php echo $c['AlarmHigh']; ?>" />
				<?php echo $b['UnitOFMeasure']; ?>
				<br />

			</td>
			
			<!-- ________________________LOW ROWS ________________________-->
			<td >
				<input type='text' id="<?php echo $b['FormName']; ?>Low" value ="<?php echo $c['AlarmLow']; ?>" /> 
				<?php echo $b['UnitOFMeasure']; ?>
				<br />

			</td>
			
		</tr>
	<?php 
	} // end foreach 
	?>
	
	</tr>
	</table>
	
	<?php
		$c1 = $connection->query("SELECT * FROM ClientBiomarkerMaster WHERE ClientID = '$id' and BioID = '9' ")->fetch();
		$c2 = $connection->query("SELECT * FROM ClientBiomarkerMaster WHERE ClientID = '$id' and BioID = '10' ")->fetch();
	?>
	
	<h3>Custom Questions</h3>
	
	<input type='checkbox' id='C1Check' 
	<?php if( $c1['isChecked']  == 1 ){ echo "checked"; } ?>
	/>
	<label for='C1Check'>1</label>
	
	<textarea id='C1Notes' style='width: 350px; resize: none;'><?php echo $c1['Notes']; ?></textarea>
	
	<input type='hidden' id='C1High' />
	<input type='hidden'  id="C1Low" />
	<input type='hidden'  id="C1Low" />
	
	<br><br>
	
	<input type='checkbox' id='C2Check' 
	<?php if( $c2['isChecked']  == 1 ){ echo "checked"; } ?>
	/>
	<label for='C2Check'>2</label>
	
	<textarea id='C2Notes' style='width: 350px; resize: none;'><?php echo $c2['Notes']; ?></textarea>
	
	<input type='hidden' id='C2High' />
	<input type='hidden'  id="C2Low" />
	<input type='hidden'  id="C2Low" />
	
	<br/><br/>
<input type='button' value="Update BioMarkers" onclick="bioEdit()" />
 







	
</body>
</html>
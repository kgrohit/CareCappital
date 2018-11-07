<?php
	include '../init.php';
	$diag = "SELECT * FROM MedicalDiagnosis ORDER BY Description ASC";
	$prov = "SELECT * FROM ProviderMaster ORDER BY LastName ASC";
	$care = "SELECT * FROM CaregiverMaster ORDER BY LastName ASC";
	$staff = "SELECT * FROM StaffMaster ORDER BY LastName ASC";
	
	//save the id
	$id = $_POST['id'];
	
	$query = $connection->query("SELECT * FROM ClientMaster WHERE ClientID= '$id' "); // change$db to $connection - cy
	$data = $query->fetch();
	
	
	// Used to set the PhoneCallFrequncy to a usable array
	$days = explode(" ", $data['PhoneCallFrequency']);
	

?>
<h3><?php echo $data['FirstName'] . ' ' . $data['LastName']; ?></h3>

<hr/>

<!--_________________________________________________________________________________________________________________________________________ -->
<script type="text/javascript" src="http://www.thesaigroup.org/wp-admin/TeleSystem/ClientMaster/js/client.js"></script>
<style>

        #col2 {
          float: right;
          text-align: right; 
          margin: 0 100px 0 0;
          
        }
        
	#col2 h3 {
	  text-align: right;
	}
	
	
	
	#monitor {
	 clear:both;
	 float: right;
	 text-align: right; 
	 margin-right: 25%;
	} 
	#monitor select {
	  max-width: 500px;
	  width: 500px;
	}
	
/* DatePicker Container */
.ui-datepicker {
    width: 216px;
    height: auto;
    margin: 5px auto 0;
    font: 9pt Arial, sans-serif;
    -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
    -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
    background-color: #777;
    color: #fff;
}
.ui-datepicker { width: auto; } 
.ui-icon-circle-triangle-w { float:left; color: #fff; cursor: pointer; }
.ui-icon-circle-triangle-e { float: right; color: #fff; cursor: pointer;}
.ui-icon-circle-triangle-e:hover { color: #2FADE2; }
.ui-icon-circle-triangle-w:hover { color: #2FADE2; }
.ui-datepicker-title { text-align: center; } 

#Daily, #MWF, #M, #Stop {
	cursor:pointer;
}

</style>

<div id='col1'>
	<h3>Basic Information</h3>

	

		Middle Name: <input type='text' id='MiddleName'  value="<?php echo $data['MiddleName']; ?>" /> <br/><br/>
		
		
		Date of Program Initiation: <?php echo $data['DateProgInit']; ?><br/><br/>
		<input id="ClientID" type="hidden"  name="ClientID" value="<?php echo $data['ClientID']; ?>">
	
		 DOB: <input type='text' id='DOB' placeholder="mm/dd/yyyy" value="<?php echo $data['DOB']; ?>" /> <br/><br/>
		 
		 Gender: 
		 <label for='GenderM' >M </label> 
		 <input type='radio' name='Gender' value='M' id='GenderM'
		 	<?php if($data['Gender'] == 'M'){
		 		echo "checked";
		 		} ?>
		  />
		 
		 <label for='GenderF' >F </label> 
		 <input type='radio' name='Gender' value='F' id='GenderF'  
		 	<?php if($data['Gender'] == 'F'){
		 		echo "checked";
		 		} ?>
		 /> </br><br/>
		 
		 ADDRESS 1: 
		 <input type='text' id='Address1' placeholder='1' value="<?php echo $data['Address1']; ?>" /> <br/>
		 2: <input type='text' id='Address2' placeholder='2' value="<?php echo $data['Address2']; ?>" /> <br/>
		 3:<input type='text' id='Address3' placeholder='3' value="<?php echo $data['Address3']; ?>" /> <br/>
		 4: <input type='text' id='Address4' placeholder='4' value="<?php echo $data['Address4']; ?>" /> <br/><br/>
		 CITY: <input type='text' name='City' id='City' value="<?php echo $data['City']; ?>" /><br/>
		 STATE: 
		 			<select id='State' name='State' >
					<option value="AL" <?php if($data['State'] == 'AL') { echo 'selected'; }  ?> >Alabama</option>
					<option value="AK" <?php if($data['State'] == 'AK') { echo 'selected'; }  ?> >Alaska</option>
					<option value="AZ" <?php if($data['State'] == 'AZ') { echo 'selected'; }  ?> >Arizona</option>
					<option value="AR" <?php if($data['State'] == 'AR') { echo 'selected'; }  ?> >Arkansas</option>
					<option value="CA" <?php if($data['State'] == 'CA') { echo 'selected'; }  ?> >California</option>
					<option value="CO" <?php if($data['State'] == 'CO') { echo 'selected'; }  ?> >Colorado</option>
					<option value="CT" <?php if($data['State'] == 'CT') { echo 'selected'; }  ?> >Connecticut</option>
					<option value="DE" <?php if($data['State'] == 'DE') { echo 'selected'; }  ?> >Delaware</option>
					<option value="DC" <?php if($data['State'] == 'DC') { echo 'selected'; }  ?> >District Of Columbia</option>
					<option value="FL" <?php if($data['State'] == 'FL') { echo 'selected'; }  ?> >Florida</option>
					<option value="GA" <?php if($data['State'] == 'GA') { echo 'selected'; }  ?> >Georgia</option>
					<option value="HI" <?php if($data['State'] == 'HI') { echo 'selected'; }  ?> >Hawaii</option>
					<option value="ID" <?php if($data['State'] == 'ID') { echo 'selected'; }  ?> >Idaho</option>
					<option value="IL" <?php if($data['State'] == 'IL') { echo 'selected'; }  ?> >Illinois</option>
					<option value="IN" <?php if($data['State'] == 'IN') { echo 'selected'; }  ?> >Indiana</option>
					<option value="IA" <?php if($data['State'] == 'IA') { echo 'selected'; }  ?> >Iowa</option>
					<option value="KS" <?php if($data['State'] == 'KS') { echo 'selected'; }  ?> >Kansas</option>
					<option value="KY" <?php if($data['State'] == 'KY') { echo 'selected'; }  ?> >Kentucky</option>
					<option value="LA" <?php if($data['State'] == 'LA') { echo 'selected'; }  ?> >Louisiana</option>
					<option value="ME" <?php if($data['State'] == 'ME') { echo 'selected'; }  ?> >Maine</option>
					<option value="MD" <?php if($data['State'] == 'MD') { echo 'selected'; }  ?> >Maryland</option>
					<option value="MA" <?php if($data['State'] == 'MA') { echo 'selected'; }  ?> >Massachusetts</option>
					<option value="MI" <?php if($data['State'] == 'MI') { echo 'selected'; }  ?> >Michigan</option>
					<option value="MN" <?php if($data['State'] == 'MN') { echo 'selected'; }  ?> >Minnesota</option>
					<option value="MS" <?php if($data['State'] == 'MS') { echo 'selected'; }  ?> >Mississippi</option>
					<option value="MO" <?php if($data['State'] == 'MO') { echo 'selected'; }  ?> >Missouri</option>
					<option value="MT" <?php if($data['State'] == 'MT') { echo 'selected'; }  ?> >Montana</option>
					<option value="NE" <?php if($data['State'] == 'NE') { echo 'selected'; }  ?> >Nebraska</option>
					<option value="NV" <?php if($data['State'] == 'NV') { echo 'selected'; }  ?> >Nevada</option>
					<option value="NH" <?php if($data['State'] == 'NH') { echo 'selected'; }  ?> >New Hampshire</option>
					<option value="NJ" <?php if($data['State'] == 'NJ') { echo 'selected'; }  ?> >New Jersey</option>
					<option value="NM" <?php if($data['State'] == 'NM') { echo 'selected'; }  ?> >New M'') exico</option>
					<option value="NY" <?php if($data['State'] == 'NY') { echo 'selected'; }  ?> >New York</option>
					<option value="NC" <?php if($data['State'] == 'NC') { echo 'selected'; }  ?> >North Carolina</option>
					<option value="ND" <?php if($data['State'] == 'ND') { echo 'selected'; }  ?> >North Dakota</option>
					<option value="OH" <?php if($data['State'] == 'OH') { echo 'selected'; }  ?> >Ohio</option>
					<option value="OK" <?php if($data['State'] == 'OK') { echo 'selected'; }  ?> >Oklahoma</option>
					<option value="OR" <?php if($data['State'] == 'OR') { echo 'selected'; }  ?> >Oregon</option>
					<option value="PA" <?php if($data['State'] == 'PA') { echo 'selected'; }  ?> >Pennsylvania</option>
					<option value="RI" <?php if($data['State'] == 'RI') { echo 'selected'; }  ?> >Rhode Island</option>
					<option value="SC" <?php if($data['State'] == 'SC') { echo 'selected'; }  ?> >South Carolina</option>
					<option value="SD" <?php if($data['State'] == 'SD') { echo 'selected'; }  ?> >South Dakota</option>
					<option value="TN" <?php if($data['State'] == 'TN') { echo 'selected'; }  ?> >Tennessee</option>
					<option value="TX" <?php if($data['State'] == 'TX') { echo 'selected'; }  ?> >Texas</option>
					<option value="UT" <?php if($data['State'] == 'UT') { echo 'selected'; }  ?> >Utah</option>
					<option value="VT" <?php if($data['State'] == 'VT') { echo 'selected'; }  ?> >Vermont</option>
					<option value="VA" <?php if($data['State'] == 'VA') { echo 'selected'; }  ?> >Virginia</option>
					<option value="WA" <?php if($data['State'] == 'WA') { echo 'selected'; }  ?> >Washington</option>
					<option value="WV" <?php if($data['State'] == 'WV') { echo 'selected'; }  ?> >West Virginia</option>
					<option value="WI" <?php if($data['State'] == 'WI') { echo 'selected'; }  ?> >Wisconsin</option>
					<option value="WY" <?php if($data['State'] == 'WY') { echo 'selected'; }  ?> >Wyoming</option>
			
		</select>  <br/>
		 ZIP: <input id="Zip" type="text"  value="<?php echo $data['Zip']; ?>"/><br/>
		 COUNTY: <input type='text'  id='County' value="<?php echo $data['County']; ?>" /><br/>
		 COUNTRY: <input type='text'  id='Country' value="<?php echo $data['Country']; ?>" /><br/><br/>
		 PHONE: <input type='text'  id='Phone' value="<?php echo $data['Phone']; ?>" /><br/>
		 FAX: <input type='text'  id='Fax' value="<?php echo $data['Fax']; ?>" /><br/>
		 EMAIL: <input type='text'  id='Email' value="<?php echo $data['Email']; ?>" />
		 <br/>
</div>	 
	<!--_________________________________________________________________________________________________________________________________________ -->	
<div id='col2'>
<br/>
<input type='button' value='Edit Biomarkers' onclick='bioForm(<?php echo $data['ClientID'] . ', "' . $data['FirstName'] . '", "' . $data['LastName'] . '"'; ?>)' />

		<h3>Physicians</h3> 
		 <!-- Drop downs use php to cycle through the values from the other tables. -->
		 PRIMARY:
		<select name='Provider1' id='Provider1' > 
		<option value=''>Select...</option>
		<?php
			foreach($connection->query($prov) as $d) { 
				print "<option value='" . $d['ProviderID'] . "'";
				if( $d['ProviderID'] == $data['PrimaryPhyID'] ){
					echo ' selected'; 
				}
				print " >" . $d['LastName']. ", ".$d['FirstName'] . "</option>"; 
			}
		?>
		</select><br/> 
		 SECONDARY:
		<select name='Provider2' id='Provider2' > 
		<option value=''>Select...</option>
		<?php
			foreach($connection->query($prov) as $d) { 
				print "<option value='" . $d['ProviderID'] . "'";
				if( $d['ProviderID'] == $data['SecondPhyID'] ){
					echo ' selected'; 
				}
				print " >" . $d['LastName']. ", ".$d['FirstName'] . "</option>"; 
			}
		?>
		</select>
		
		<h3>Caregivers</h3> 
		
		 PRIMARY:
		<select name='Caregiver1' id='Caregiver1'>
			<option value=''>Select...</option>
			<?php
				foreach($connection->query($care) as $c) { 
					print "<option value='" . $c['CaregiverID'] . "'";
					if( $c['CaregiverID'] == $data['PrimaryCareID']){
						echo ' selected ';
					}
					print ">" . $c['LastName'] . ", " . $c['FirstName'] . "</option>";
				}
			?>
		</select><br/> 
		 SECONDARY:
		<select name='Caregiver2' id='Caregiver2'>
			<option value=''>Select...</option>
			<?php
				foreach($connection->query($care) as $c) { 
					print "<option value='" . $c['CaregiverID'] . "'";
					if( $c['CaregiverID'] == $data['SecondCareID']){
						echo ' selected ';
					}
					print ">" . $c['LastName'] . ", " . $c['FirstName'] . "</option>";
				}
			?>
		</select>
		
		<h3>Diagnoses</h3> 
		 1:
			<select name='Diagnosis1' id='Diagnosis1' > 
			<option value=''>Select...</option>
			<?php
				foreach($connection->query($diag) as $d) { 
					print "<option value='" . $d['ICD'] . "'";
					if( $d['ICD'] == $data['Diagnosis1'] ){
						echo ' selected';  
					}
					print " >" . $d['Description'] . "</option>"; 
				}
			?>
			</select><br/>
		2:   
			<select name='Diagnosis2' id='Diagnosis2' >
			<option value=''>Select...</option>
			<?php
				foreach($connection->query($diag) as $d) { 
					print "<option value='" . $d['ICD'] . "'";
					if( $d['ICD'] == $data['Diagnosis2'] ){
						echo ' selected'; 
					}
					print " >" . $d['Description'] . "</option>";
				}
			?>
			</select><br/>
		3:   
			<select name='Diagnosis3' id='Diagnosis3' >
			<option value=''>Select...</option>
			<?php
				foreach($connection->query($diag) as $d) { 
					print "<option value='" . $d['ICD'] . "'";
					if( $d['ICD'] == $data['Diagnosis3'] ){
						echo ' selected';  
					}
					print " >" . $d['Description'] . "</option>";
				}
			?>
			</select><br/>
		4:   
			<select name='Diagnosis4' id='Diagnosis4' >
			<option value=''>Select...</option>
			<?php
				foreach($connection->query($diag) as $d) { 
					print "<option value='" . $d['ICD'] . "'";
					if( $d['ICD'] == $data['Diagnosis4'] ){
						echo ' selected';  
					}
					print " >" . $d['Description'] . "</option>";
				}
			?>
			</select>
			
</div>	
			
			
			<!-- Monitoring Program -->
	
<div id='monitor' style="display: block; clear:both; text-align: right;" >
	<p>
		<h3>Monitoring Program</h3>   
		START DATE: <input type='text' id='startDate' placeholder='mm/dd/yyyy' value="<?php echo $data['MonitoringStartDate']; ?>" />  
		END DATE: <input type='text' id='endDate' placeholder='mm/dd/yyyy' value="<?php echo $data['MonitoringEndDate']; ?>" /> <br/><br/>
	</p>
	
	
	<!-- OLD PHONE CALL FREQ
	<p>
		PHONE CALL:
		
		<input type='radio' name='radPhone' value='Daily' id='phoneDaily'
		<?php
			if( $data['PhoneCallFrequency'] == 'Daily' ) { echo 'checked'; }
		 ?> />  
		<label for='phoneDaily' >Daily</label> 
			
		<input type='radio' name='radPhone' value='Alternate Days' id='phoneAlternateDays'
		<?php
			if( $data['PhoneCallFrequency'] == 'Alternate Days' ) { echo 'checked'; }
		 ?>  />  
		<label for='phoneAlternateDays' >Alternate days</label> 
			
		<input type='radio' name='radPhone' value='Weekly' id='phoneWeekly'
		<?php
			if( $data['PhoneCallFrequency'] == 'Weekly' ) { echo 'checked'; }
		 ?>  />  
		<label for='phoneWeekly' >Weekly</label> 
			
		<input type='radio' name='radPhone' value='Monthly' id='phoneMonthly' 
		<?php
			if( $data['PhoneCallFrequency'] == 'Monthly' ) { echo 'checked'; }
		 ?> />  
		<label for='phoneMonthly' >Monthly</label> 
			
		<input type='radio' name='radPhone' value='Stop Monitoring' id='phoneStopMonitoring'
		<?php
			if( $data['PhoneCallFrequency'] == 'Stop Monitoring' ) { echo 'checked'; }
		 ?>  />  
		<label for='phoneStopMonitoring' >Stop Monitoring</label> 
		
		
	</p>	-->
	<!-- NEW PHONE CALL FREQ -->
	<a onclick='setCallFreq(this.id)' id='Daily'>Daily</a> | 
	<a onclick='setCallFreq(this.id)' id='MWF'>M-W-F</a> | 
	<a onclick='setCallFreq(this.id)' id='M'>Once a Week</a> | 
	<a onclick='setCallFreq(this.id)' id='Stop'>Stop Calling</a> 
	
	<table>
	
	<tr>
		<td> 
		  <label for='Mon'>Mon</label> 
		  <input type='checkbox' value='1' id='Mon'  
		  <?php if( in_array(1,  $days))  { echo "checked"; } ?> /> 
		</td>
		
		<td> 
		  <label for='Tue'>Tue</label> 
		  <input type='checkbox' value='2' id='Tue' 
		  <?php if( in_array(2,  $days))  { echo "checked"; } ?> /> 
		</td>
		
		<td> 
		  <label for='Wed'>Wed</label> 
		  <input type='checkbox' value='3' id='Wed' 
		  <?php if( in_array(3,  $days))  { echo "checked"; } ?> /> 
		</td>
		
		<td> 
		  <label for='Thu'>Thu</label> 
		  <input type='checkbox' value='4' id='Thu' 
		  <?php if( in_array(4,  $days))  { echo "checked"; } ?> /> 
		</td>
		
		<td> 
		  <label for='Fri'>Fri</label> 
		  <input type='checkbox' value='5' id='Fri' 
		  <?php if( in_array(5,  $days))  { echo "checked"; } ?> /> 
		</td>
		
		<td> 
		  <label for='Sat'>Sat</label> 
		  <input type='checkbox' value='6' id='Sat' 
		  <?php if( in_array(6,  $days))  { echo "checked"; } ?> /> 
		</td>
		
		<td> 
		  <label for='Sun'>Sun</label> 
		  <input type='checkbox' value='7' id='Sun' 
		  <?php if( in_array(7,  $days))  { echo "checked"; } ?> /> 
		</td>
	</tr>
	</table>
	<br>
	
	<p> 
	
		Time to call:
		
		<select id='timeToCall' style='width: 150px;' >
			<?php /*
				// start time at 6am
				for( $i = 6; $i <= 21; $i++ ) {
				
				//This handles the times with 00 minutes.
					$time = date("h:i:s", mktime($i, 0, 0, 0, 0, 0) ); //create time
					if($i < 12) { $time = $time . " AM"; } else { $time = $time . " PM"; } //append am pm
					
					echo "<option "; 
					echo "value='" . $time . "' "; 
					if( $time == $data['PhoneCallTime'] ) { echo 'selected'; } // select database value
					echo ">" . $time;  
					echo "</option>";
					
				// stop loop if its 9pm. Prevents 9:30 from showing
					if( $i == 21) { break; } 
					
				// This handles the 30 minute times.
					$time = date("h:i:s", mktime($i, 30, 0, 0, 0, 0) );
					if($i < 12) { $time = $time . " AM"; } else { $time = $time . " PM"; }
					
					
					echo "<option ";
					echo "value='" . $time . "' ";
					if( $time == $data['PhoneCallTime'] ) { echo 'selected'; }
					echo ">" . $time; 
					echo "</option>";
					
				}*/ 
				
				for( $i = 6; $i <= 21; $i++){
				    for($m=0;$m<=59;$m +=30){
					$time = date("H:i:s", mktime($i, $m, 0, 0, 0, 0) );
					$timedisplay = date("h:i:s a", mktime($i, $m, 0, 0, 0, 0) );
					echo "<option "; 
					echo "value='" . $time . "' "; 
					if( $time == $data['PhoneCallTime'] ) { echo 'selected'; } // select database value
					echo ">" . $timedisplay ;  
					echo "</option>";
				    }
					
				}
			?>
		</select><br/>
		


			
		TIME ZONE:
		<select id='timezone' >
			<option value="-4" <?php if($data['TimeZone'] == -4){echo 'selected';} ?> >(UTC -4:00) New York, EDT</option>
			<option value="-5" <?php if($data['TimeZone'] == -5){echo 'selected';} ?> >(UTC -5:00) Chicago, CDT</option>
			<option value="-6" <?php if($data['TimeZone'] == -6){echo 'selected';} ?> >(UTC -6:00) Salt Lake city, MDT</option>
			<option value="-7" <?php if($data['TimeZone'] == -7){echo 'selected';} ?> >(UTC -7:00) Los Angeles, PDT</option>
			<option value="-8" <?php if($data['TimeZone'] == -8){echo 'selected';} ?> >(UTC -8:00) Anchorage, AKDT</option>
			<option value="-10" <?php if($data['TimeZone'] == -10){echo 'selected';} ?>>(UTC -10:00) Honolulu, HAST</option>
		</select>
		
			
		
	</p>
	
	
	
	
	


<br/>
			
</div>		
	<!--_________________________________________________________________________________________________________________________________________ -->
<div style='clear:both;'>
			<h3>Reports</h3>
			
			<p class='center-text'> PERSONS AUTHORIZED TO RECEIVE REPORTS: </p>
			
			<table id='report-table'>
				<tr>
					<td>A. Client</td>
					<td><input type='radio' name='clientSchedule' value='Weekly' id='clientReportWeekly' 
						<?php if($data['ClientSchedule'] == 'Weekly'){
							echo "checked";
						} ?>
					/><label for='clientReportWeekly' >Weekly </label></td>
				
						
					<td><input type='radio' name='clientSchedule' value='BiWeekly' id='clientReportBiWeekly'
						<?php if($data['ClientSchedule'] == 'BiWeekly'){
							echo "checked";
						} ?>
					/><label for='clientReportBiWeekly' >Bi-Weekly</label></td>
					
						
					<td><input type='radio' name='clientSchedule' value='Monthly' id='clientReportMonthly'
						<?php if($data['ClientSchedule'] == 'Monthly'){
							echo "checked";
						} ?>
					 /><label for='clientReportMonthly' >Monthly </label></td>
						
					<td><input type='radio' name='clientSchedule' value='No Report' id='clientReportIsntWanted'
						<?php if($data['ClientSchedule'] == 'No Report'){
							echo "checked";
						} ?>
					/><label for='clientReportIsntWanted' >Does not Wish to recieve</label></td>
				</tr>
				
				<tr>
					<td>
						B.
						<select id='StaffID' > // Change staffMember to StaffID
								<option value=''>Facility Staff</option>
								<?php
									foreach($connection->query($staff) as $s) { 
										print "<option value='" . $s['StaffID'] . "'";  // Change lastname and firstname to StaffID
																				
										if($s['StaffID'] == $data['StaffID']  ){  
											echo ' selected ';  // Change staffMember to StaffID
										}
										print ">" . $s['LastName'] . ", " . $s['FirstName'] . "</option>";
									}
								?>
						</select>
					</td>
					
						
					<td><input type='radio' name='staffSchedule' value='Weekly' id='staffReportWeekly' 
						<?php if($data['StaffSchedule'] == 'Weekly'){
							echo " checked";
						} ?>
					/><label for='staffReportWeekly' >Weekly </label></td>
				
						
					<td><input type='radio' name='staffSchedule' value='BiWeekly' id='staffReportBiWeekly'
						<?php if($data['StaffSchedule'] == 'BiWeekly'){
							echo " checked";
						} ?>
					/><label for='staffReportBiWeekly' >Bi-Weekly</label></td>
					
						
					<td><input type='radio' name='staffSchedule' value='Monthly' id='staffReportMonthly'
						<?php if($data['StaffSchedule'] == 'Monthly'){
							echo " checked";
						} ?>
					 /><label for='staffReportMonthly' >Monthly </label></td>
						
					<td><input type='radio' name='staffSchedule' value='No Report' id='staffReportIsntWanted'
						<?php if($data['StaffSchedule'] == 'No Report'){
							echo " checked";
						} ?>
					/><label for='staffReportIsntWanted' >Does not Wish to recieve</label></td>	
				</tr>
				
				
				
				<tr>
					<td>C. Primary Provider</td>
					
					<td><input type='radio' name='provider1Schedule' value='Weekly' id='provider1weekly' 
						<?php if($data['Provider1Schedule'] == 'Weekly'){
							echo "checked";
						} ?>
					/><label for='provider1weekly' >Weekly </label></td>
				
						
					<td><input type='radio' name='provider1Schedule' value='BiWeekly' id='provider1BiWeekly'
						<?php if($data['Provider1Schedule'] == 'BiWeekly'){
							echo "checked";
						} ?>
					/><label for='provider1BiWeekly' >Bi-Weekly</label></td>
					
						
					<td><input type='radio' name='provider1Schedule' value='Monthly' id='provider1Monthly'
						<?php if($data['Provider1Schedule'] == 'Monthly'){
							echo "checked";
						} ?>
					 /><label for='provider1Monthly' >Monthly </label></td>
						
					<td><input type='radio' name='provider1Schedule' value='No Report' id='provider1ReportIsntWanted'
						<?php if($data['Provider1Schedule'] == 'No Report'){
							echo "checked";
						} ?>
					/><label for='provider1ReportIsntWanted' >Does not Wish to recieve</label></td>
				</tr>
				
				<tr>
					<td>D. Secondary Provider</td>
					
					<td><input type='radio' name='provider2Schedule' value='Weekly' id='provider2weekly' 
						<?php if($data['Provider2Schedule'] == 'Weekly'){
							echo "checked";
						} ?>
					/><label for='provider2weekly' >Weekly </label></td>
				
						
					<td><input type='radio' name='provider2Schedule' value='BiWeekly' id='provider2BiWeekly'
						<?php if($data['Provider2Schedule'] == 'BiWeekly'){
							echo "checked";
						} ?>
					/><label for='provider2BiWeekly' >Bi-Weekly</label></td>
					
						
					<td><input type='radio' name='provider2Schedule' value='Monthly' id='provider2Monthly'
						<?php if($data['Provider2Schedule'] == 'Monthly'){
							echo "checked";
						} ?>
					 /><label for='provider2Monthly' >Monthly </label></td>
						
					<td><input type='radio' name='provider2Schedule' value='No Report' id='provider2ReportIsntWanted'
						<?php if($data['Provider2Schedule'] == 'No Report'){
							echo "checked";
						} ?>
					/><label for='provider2ReportIsntWanted' >Does not Wish to recieve</label></td>
				</tr>
				
				<tr>
					<td>E. Primary Caregiver</td>
	
					<td><input type='radio' name='Care1Schedule' value='Weekly' id='care1Weekly' 
						<?php if($data['Care1Schedule'] == 'Weekly'){
							echo "checked";
						} ?>
					/><label for='care1Weekly' >Weekly </label></td>
				
						
					<td><input type='radio' name='Care1Schedule' value='BiWeekly' id='care1BiWeekly'
						<?php if($data['Care1Schedule'] == 'BiWeekly'){
							echo "checked";
						} ?>
					/><label for='care1BiWeekly' >Bi-Weekly</label></td>
					
						
					<td><input type='radio' name='Care1Schedule' value='Monthly' id='care1Monthly'
						<?php if($data['Care1Schedule'] == 'Monthly'){
							echo "checked";
						} ?>
					 /><label for='care1Monthly' >Monthly </label></td>
						
					<td><input type='radio' name='Care1Schedule' value='No Report' id='care1ReportIsntWanted'
						<?php if($data['Care1Schedule'] == 'No Report'){
							echo "checked";
						} ?>
					/><label for='care1ReportIsntWanted' >Does not Wish to recieve</label></td>
				</tr>
				
				<tr>
					<td>F. Secondary Caregiver</td>
					
					<td><input type='radio' name='Care2Schedule' value='Weekly' id='care2Weekly' 
						<?php if($data['Care2Schedule'] == 'Weekly'){
							echo "checked";
						} ?>
					/><label for='care2Weekly' >Weekly </label></td>
				
						
					<td><input type='radio' name='Care2Schedule' value='BiWeekly' id='care2BiWeekly'
						<?php if($data['Care2Schedule'] == 'BiWeekly'){
							echo "checked";
						} ?>
					/><label for='care2BiWeekly' >Bi-Weekly</label></td>
					
						
					<td><input type='radio' name='Care2Schedule' value='Monthly' id='care2Monthly'
						<?php if($data['Care2Schedule'] == 'Monthly'){
							echo "checked";
						} ?>
					 /><label for='care2Monthly' >Monthly </label></td>
						
					<td><input type='radio' name='Care2Schedule' value='No Report' id='care2ReportIsntWanted'
						<?php if($data['Care2Schedule'] == 'No Report'){
							echo "checked";
						} ?>
					/><label for='care2ReportIsntWanted' >Does not Wish to recieve</label></td>
				</tr>
			</table>
		
		<br/><br/>
	</div>
<input type='button' id='btnEditClient' onclick='editClient()' value='Save'/>
<?php if( $_SESSION['user']['Role'] === 'admin2'): ?>
<input type='button' id='btnDeleteClient' onclick='deleteClient()' value='Delete'/>
<?php endif; ?>
<br/>


<script>
	$('#FirstName').val("<?php echo $data['FirstName']; ?>");
	$('#LastName').val("<?php echo $data['LastName']; ?>");
	
</script>
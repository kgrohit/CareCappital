<?php
	include '../init.php';
	$diag = "SELECT * FROM MedicalDiagnosis ORDER BY Description ASC";
	$prov = "SELECT * FROM ProviderMaster ORDER BY LastName ASC";
	$care = "SELECT * FROM CaregiverMaster ORDER BY LastName ASC";
	$staff = "SELECT * FROM StaffMaster ORDER BY LastName ASC";
	
	//save the id - cy 9/25/15
	$id = $_POST['id'];
	
	$query = $connection->query("SELECT * FROM ClientMaster WHERE ClientID= '$id' "); // change$db to $connection - cy
	$data = $query->fetch();
	
	
	
?>
<h1> Registration</h1><hr/>

<!--_________________________________________________________________________________________________________________________________________ -->
<!-- <link rel='stylesheet' href="http://www.thesaigroup.org/wp-admin/TeleSystem/js/timepicker/jquery.timepicker.css" /> -->
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

<div id='col1' >
	<h3>Basic Information</h3>
	 DOB <input type='text' id='DOB' placeholder="mm/dd/yyyy" /> <br/><br/>
	 Gender: 
	 <label for='GenderM' >M </label> <input type='radio' name='Gender' value='M' id='GenderM' />
	 <label for='GenderF' >F </label> <input type='radio' name='Gender' value='F' id='GenderF'  /> </br><br/>
	 ADDRESS <br> 
	 1: <input type='text' id='Address1' placeholder='1' /> <br/>
	 2: <input type='text' id='Address2' placeholder='2' /> <br/>
	 3: <input type='text' id='Address3' placeholder='3' /> <br/>
	 4: <input type='text' id='Address4' placeholder='4' /> <br/><br/>
	 
	 CITY: <input type='text' name='City' id='City'/><br/>
	 STATE: <select name='State' id='State' > 
		<option value='' >Select...</option> 
		<option value='AL'>Alabama</option> 
		<option value='AK'>Alaska</option> 
		<option value='AZ'>Arizona</option> 
		<option value='AR'>Arkansas</option> 
		<option value='CA'>California</option> 
		<option value='CO'>Colorado</option> 
		<option value='CT'>Connecticut</option> 
		<option value='DE'>Delaware</option> 
		<option value='DC'>District Of Columbia</option> 
		<option value='FL'>Florida</option> 
		<option value='GA'>Georgia</option> 
		<option value='HI'>Hawaii</option> 
		<option value='ID'>Idaho</option> 
		<option value='IL'>Illinois</option> 
		<option value='IN'>Indiana</option> 
		<option value='IA'>Iowa</option> 
		<option value='KS'>Kansas</option> 
		<option value='KY'>Kentucky</option> 
		<option value='LA'>Louisiana</option> 
		<option value='ME'>Maine</option> 
		<option value='MD'>Maryland</option> 
		<option value='MA'>Massachusetts</option> 
		<option value='MI'>Michigan</option> 
		<option value='MN'>Minnesota</option> 
		<option value='MS'>Mississippi</option> 
		<option value='MO'>Missouri</option> 
		<option value='MT'>Montana</option> 
		<option value='NE'>Nebraska</option> 
		<option value='NV'>Nevada</option> 
		<option value='NH'>New Hampshire</option> 
		<option value='NJ'>New Jersey</option> 
		<option value='NM'>New Mexico</option> 
		<option value='NY'>New York</option> 
		<option value='NC'>North Carolina</option> 
		<option value='ND'>North Dakota</option> 
		<option value='OH'>Ohio</option> 
		<option value='OK'>Oklahoma</option> 
		<option value='OR'>Oregon</option> 
		<option value='PA'>Pennsylvania</option> 
		<option value='RI'>Rhode Island</option> 
		<option value='SC'>South Carolina</option> 
		<option value='SD'>South Dakota</option> 
		<option value='TN'>Tennessee</option> 
		<option value='TX'>Texas</option> 
		<option value='UT'>Utah</option> 
		<option value='VT'>Vermont</option> 
		<option value='VA'>Virginia</option> 
		<option value='WA'>Washington</option> 
		<option value='WV'>West Virginia</option> 
		<option value='WI'>Wisconsin</option> 
		<option value='WY'>Wyoming</option> 
	</select>  <br/>
	 ZIP: <input id="Zip" type="text" /><br/><br/>
	 COUNTY: <input type='text'  id='County' /><br/>
	 COUNTRY: <input type='text'  id='Country' /><br/><br/>
	 PHONE: <input type='text'  id='Phone'/><br/>
	 FAX: <input type='text'  id='Fax'/><br/>
	 EMAIL: <input type='text'  id='Email'/>
	 </br>
</div>

	 
<!--_________________________________________________________________________________________________________________________________________ -->	 

	 <!-- Drop downs use php to cycle through the values from the other tables. -->

<div id='col2'>
	 <h3>Physicians</h3> 
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
	<select name='Provider2' id='Provider2'>
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
	</select><br/>
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
	</select><br/>
	<h3>Diagnoses</h3> 
	 DIAGNOSIS 1:

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
	DIAGNOSIS 2:  
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
	DIAGNOSIS 3:  
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
	DIAGNOSIS 4: 
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
		</select><br/>
		
		<br/><br/><br/>
		
		

</div>



<div id='monitor' >
	<p>
		<h3>Monitoring Program</h3>   
		START DATE: <input type='text' id="startDate"  style='width: 25%;' />  <br/>
		END DATE: <input type='text' id='endDate'  style='width: 25%;' /> <br/><br/>
	</p>
	
	<a onclick='setCallFreq(this.id)' id='Daily'>Daily</a> | 
	<a onclick='setCallFreq(this.id)' id='MWF'>M-W-F</a> | 
	<a onclick='setCallFreq(this.id)' id='M'>Once a Week</a> | 
	<a onclick='setCallFreq(this.id)' id='Stop'>No Calls</a> 
	
	<table>
	
	<tr>
		<td> 
		  <label for='Mon'>Mon</label> 
		  <input type='checkbox' value='1' id='Mon'  />
		</td>
		
		<td> 
		  <label for='Tue'>Tue</label> 
		  <input type='checkbox' value='2' id='Tue' />
		</td>
		
		<td> 
		  <label for='Wed'>Wed</label> 
		  <input type='checkbox' value='3' id='Wed' />
		</td>
		
		<td> 
		  <label for='Thu'>Thu</label> 
		  <input type='checkbox' value='4' id='Thu' />
		</td>
		
		<td> 
		  <label for='Fri'>Fri</label> 
		  <input type='checkbox' value='5' id='Fri' />
		</td>
		
		<td> 
		  <label for='Sat'>Sat</label> 
		  <input type='checkbox' value='6' id='Sat' />
		</td>
		
		<td> 
		  <label for='Sun'>Sun</label> 
		  <input type='checkbox' value='7' id='Sun' />
		</td>
	</tr>
	</table>
	<br>
	Time to call:
		
		<select id='timeToCall' style='width:150px;'  >
			<option value="">Select...<option>
			<?php
				// start time at 6am
				for( $i = 6; $i <= 21; $i++ ) {
				
				//This handles the times with 00 minutes.
					$time = date("h:i", mktime($i, 0, 0, 0, 0, 0) ); //create time
					if($i < 12) { $time = $time . " AM"; } else { $time = $time . " PM"; } //append am pm
					
					echo "<option "; 
					echo "value='" . $time . "' "; 
					if( $time == $data['PhoneCallTime'] ) { echo 'selected'; } // select database value
					echo ">" . $time;  
					echo "</option>";
					
				// stop loop if its 9pm. Prevents 9:30 from showing
					if( $i == 21) { break; } 
					
				// This handles the 30 minute times.
					$time = date("h:i", mktime($i, 30, 0, 0, 0, 0) );
					if($i < 12) { $time = $time . " AM"; } else { $time = $time . " PM"; }
					
					
					echo "<option ";
					echo "value='" . $time . "' ";
					if( $time == $data['PhoneCallTime'] ) { echo 'selected'; }
					echo ">" . $time; 
					echo "</option>";
					
				}
			?>
		</select><br/>
		


			
		TIME ZONE:
		<select id='timezone'>
			<option value="" <?php if($data['TimeZone'] == '' ){echo 'selected';} ?> >Select...</option>
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
		
		
	</div>
	
<br/><br/>

<input type='button' id='btnAddClient' onclick='checkClient()' value='Add Client'/>
<br/>







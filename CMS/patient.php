<?php
	
	include '../init.php';
	
	$id = $_POST['id'];//client id
	
	//run check to see if user has access to client	
	//print_r($_SESSION['user']);
	
	if(!checkAccess($_SESSION['user']['TypeID'], $_SESSION['user']['AccountType'], $id ) ){
		die('You are trying to access a client that you are not registered with.');
	}
		
	
	
	
	
	$client = $connection->query("SELECT * FROM ClientMaster WHERE ClientID = ". $id)->fetch();
	
	
	// used for clientmaster link
	$first = $client['FirstName'];
	$last = $client['LastName'];
	
	$link = "http://www.thesaigroup.org/wp-admin/TeleSystem/ClientMaster/index.php?id=$id&first=$first&last=$last";
	
	$prov1 = $connection->query("SELECT FirstName, LastName, Phone FROM ProviderMaster WHERE ProviderID = '". $client['PrimaryPhyID']. "'")->fetch();
	$prov2 = $connection->query("SELECT FirstName, LastName, Phone FROM ProviderMaster WHERE ProviderID = '". $client['SecondPhyID']. "'")->fetch();
	
	$staff = $connection->query("SELECT FirstName, LastName, Phone FROM StaffMaster WHERE StaffID = '". $client['StaffID']. "'")->fetch();
	
	$care1 = $connection->query("SELECT FirstName, LastName, Phone FROM CaregiverMaster WHERE CaregiverID = '". $client['PrimaryCareID']. "'")->fetch();
	$care2 = $connection->query("SELECT FirstName, LastName, Phone FROM CaregiverMaster WHERE CaregiverID = '". $client['SecondCareID']. "'")->fetch();

?>


<!-- 
		CLIENT INFO
-->
<div id='PatientToolbar' style=' text-align: left; display: block; vertical-align: top;' >
	<div style=' display: inline-block; margin-right: 10px; vertical-align: top;' >
	<div style='display:inline-block; text-align:right;'>

		<!-- if user is staff, give link to a registration page. ELSE Show name normally -->
		<?php if( $_SESSION['user']['AccountType'] == 'staff'): ?>
			<h2 style='text-align: left;' >
			<a href="<?php echo $link?>" >
			<?php echo $client['FirstName'] . " ". $client['LastName']; ?>
			</a>
			</h2>
		<?php endif; if( $_SESSION['user']['AccountType'] != 'staff'): ?>
			<h2 style='text-align: left;' >
			<?php echo $client['FirstName'] . " ". $client['LastName']; ?>
			</h2>
		<?php endif;  ?>
		
		
		<span><img src="phone-icon.png" /> <?php echo $client['Phone']; ?> </span><br/>
		<span><img src="house-icon.png" /> <?php echo $client['Address1']; ?> </span><br/>


		
		
	</div>
	</div>
	
	<!-- 
	MEDICAL CONTACT INFO		
	-->
	<div style=' display: inline-block; margin-left: 5px;'>
		<div style='display:inline-block; text-align: right;'>

			<input type='hidden' id="ClientID" value="<?php echo $id; ?>" />
			
			<div style='display:inline;text-align: right; vertical-align: top;'>
			<div  style='display:inline-block; vertical-align: top;  padding: 5px; '>
			
			<h4>Providers</h4> 
			
			<?php echo $prov1['FirstName']. " ". $prov1['LastName']; ?>
			<br>
			<?php echo $prov1['Phone']; ?><br><br>
			<?php echo $prov2['FirstName']. " ". $prov2['LastName']; ?>
			<br>
			<?php echo $prov2['Phone']; ?>
			</div>

			<div style='display:inline-block;text-align: right;vertical-align: top; padding: 5px;'>
			
			<h4>Care</h4>
			
			<?php echo $care1['FirstName']. " ". $care1['LastName']; ?>
			<br>
			<?php echo $care1['Phone']; ?>
			<br><br>
			<?php echo $care2['FirstName']. " ". $care2['LastName']; ?>
			<br>
			<?php echo $care2['Phone']; ?>
			</div>

			<div  style='display:inline-block;text-align: right;vertical-align: top;  padding: 5px;'>
			
			<h4>Staff</h4>
			
			<?php echo $staff['FirstName']. " ". $staff['LastName']; ?>
			<br>
			<?php echo $staff['Phone']; ?><br><br>
			
			
			</div>
			
			<?php if( $_SESSION['user']['Role'] == 'admin2' ): ?>
				<a onclick="recallPatient( <?php echo $client['ClientID']; ?> )" style='cursor:pointer;padding: 5px;'  >Recall Patient</a>
			<?php endif; ?>

		
		</div>
		
	
	</div>
</div>

<br><br>

<!--Save the DateProgInit and Curdate as values to reset the datepickers -->
<input type='hidden'  id='clientid' value="<?php echo $client['ClientID']; ?>" />
<input type='hidden'  id='Date1Default' value="<?php echo $client['DateProgInit']; ?>" /> 
<input type='hidden'  id='Date2Default'  value="<?php echo date('Y-m-d'); ?>" />



</div>

<div style='text-align: left; display: block;'>
<input type='button' onclick='showAdminView()' value='Admin Tools' />
<input type='button' onclick='showChartView()' value='Chart Tools' />
</div>


<!-- 
		BIOMARKER READINGS
-->
<!--
<div id='PatientToolbar' >
	<h2 style='text-align: left; display: inline;' >Biomarker Readings</h2>
	
		
	
	
	
	<!--Save the DateProgInit and Curdate as values to reset the datepickers --><!--
	<input type='hidden'  id='clientid' value="<?php echo $client['ClientID']; ?>" />
	<input type='hidden'  id='Date1Default' value="<?php echo $client['DateProgInit']; ?>" /> 
	<input type='hidden'  id='Date2Default'  value="<?php echo date('Y-m-d'); ?>" />
	
	<!-- Datepickers --><!--
	<input type='text'  id='Date1' value="<?php echo $client['DateProgInit']; ?>" onchange="handlePatientDates()" /> - TO - 
	<input type='text'  id='Date2'  value="<?php echo date('Y-m-d'); ?>" onchange="handlePatientDates()" />

	<?php if( $_SESSION['user']['Role'] == 'admin2' ): ?>
		<!-- <input type='button' value='Recall Patient' onclick="recallPatient( <?php echo $client['ClientID']; ?> )"  /> --><!--
		<a onclick="recallPatient( <?php echo $client['ClientID']; ?> )" style='cursor:pointer;'  >Recall Patient</a>
	<?php 
	
	endif;
	
	//href value for excel link
	//$link = "convertToCSV.php?clientid=". $id. "&date1=". $client['DateProgInit']. "&date2=". date('Y-m-d'). "";
	$link = "convertToCSV.php?clientid=52"."&date1=". $client['DateProgInit']. "&date2=". date('Y-m-d'). "";
	 ?> 
	

	
	<a href="<?php echo  $link ?>"  id='excel-link' >Export to Excel</a>
	
	<a onclick="showChartView()" id='chart-link' style='cursor:pointer;'>Chart Tools</a>
</div><!-- PatientToolbar -->
<div id='patientToolbar'></div>
<br><br>
<div id='bioreadings'>

</div>


<script>
	showAdminView();
</script>


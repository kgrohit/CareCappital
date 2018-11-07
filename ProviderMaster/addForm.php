<?php
	include '../init.php';
	$disc = "SELECT * FROM DisciplineMaster ORDER BY Description ASC";
	
	//save the id
	$id = $_POST['id'];

	//statement for provider data
	$query = $connection->query("SELECT * FROM ProviderMaster WHERE ProviderID = '$id' ");
        
	$data = $query->fetch();
	
?>

<div id='col1' name='col1'>
	<label for='Phone'>Phone: </label><input type='text' name='Phone' id='Phone' onkeypress=' return isNumberKey( event )' /><br/> 
	<label for='Fax'>Fax: </label><input type='text' name='Fax' id='Fax' onkeypress=' return isNumberKey( event )' /><br/>
	<label for='Zip'>Zip: </label><input type='text' name='Zip' id='Zip' onkeypress=' return isNumberKey( event )' maxlength='5'/><br/>
</div>


<!--  COL2 DIV START -->
<div id='col2' name='col2' >

	<label for="DisciplineID">Discipline: </label>
	<select name='DisciplineID' id='DisciplineID' >
	    	<option value='' <?php if($data['DisciplineID'] == '') { echo 'selected'; }  ?> > Select a discipline...</option>
	    	<?php
			foreach($connection->query($disc) as $d) { 
				print "<option value='" . $d['DisciplineID'] . "'"; // Changed Description to DisciplineID - cy
				if( $d['DisciplineID'] == $data['DisciplineID'] ){ 
					echo ' selected'; // Changed Description to DisciplineID - cy
				}
				print " >" . $d['Description'] . "</option>"; // Changed Description to DisciplineID, opion to option - cy
			}	
		?>
    	</select>
	
	<!--  Address box -->
	<div id='addressbox'> 
		<label for='Address1'  >Address1: </label>
		<input type='text' name='Address1' id='Address1' style='width: 200px'/><br/> 
		<label for='Address2'  >Address2: </label>
		<input type='text' name='Address2' id='Address2' style='width: 200px'/><br/>
		<label for='Address3'  >Address3: </label>
		<input type='text' name='Address3' id='Address3' style='width: 200px'/><br/>
		<label for='Address4'  >Address4: </label>
		<input type='text' name='Address4' id='Address4' style='width: 200px'/><br/>
	</div>  
	<!-- alt method, cy - 11/17/15
	<input type='button' value='Add Another Line' onClick='AddAddress(`addressbox`)' ><br/><br/> 
	-->
	
	<!--  location-->
	<label for='City'>City: </label><input type='text' name='City' id='City' /></br> 
	
	<!--  state dropdown -->
	<label for='State'>State</label><select name='State' id='State' > 
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
	</select><br/> 
	
	
	<label for='County'>County: </label><input type='text' name='County' id='County' /></br> 
	<label for='Country'>Country: </label><input type='text' name='Country' id='Country' /><br/> 
	
	
	<!--  contact info -->
	<label for='Email'>Email: </label><input type='text' name='Email' id='Email' /><br/><br/> 
	Preferred method of contact:<br/> 
	<label for='CommMethod1'>Phone: </label><input type='checkbox' name='CommMethod1' id='CommMethod1' checked /><br/> 
	<label for='CommMethod2'>Email: </label><input type='checkbox' name='CommMethod2' id='CommMethod2' checked /><br/></br> 
	
	
</div> <!--  col2 div -->

<!--   button -->
	<input type='button' value='Add' name='add_button' id='add_button' onClick='checkProvider()' style='clear: both; display: block; padding: 10px; width: 10%; margin: 0 0 0 35%;'/>
	<br/><br/>
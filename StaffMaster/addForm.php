<?php
	include '../init.php';
	$disc = "SELECT * FROM DisciplineMaster ORDER BY Description ASC";
	
	//save the id
	$id = $_POST['id'];

	//get the username 
	$sql = "SELECT * FROM UserMaster WHERE TypeID= '$id' ";
	foreach($connection->query($sql) as $row) {
		$username = $row['UserName'];
	}

	// get the rest of the info
	$query = $connection->query("SELECT * FROM StaffMaster WHERE StaffID= '$id' ");    
	$data = $query->fetch();
	
?>

<style>

#save_status input[type='text'], #save_status select {
  text-align: right;
  width: 90%;

 
}

table, tr, td { border: 0; }
table {
	background-color: #eee;
	table-layout: fixed;
}
td {
	vertical-align: top;
	text-align: right;
	width: 50%;
}


</style>
<h3>Add a staff member</h3>

<table>
<tr>
<td>

<div id=' ' class='col-xs-6 ' >

	
	
	<div class="form-group">
		<label class="control-label col-md-2" for="MiddleName">Middle:</label>
		<div class="col-md-10">          
			<input type="text" class="form-control" id="MiddleName" >
		</div>
	</div>
	
	

	<hr>
	
	<div class="form-group">
		<label class="control-label col-md-2" for="Phone">Phone:</label>
		<div class="col-md-10">          
			<input type="text" class="form-control" id="Phone" >
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2" for="Fax">Fax:</label>
		<div class="col-md-10">          
			<input type="text" class="form-control" id="Fax" >
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2" for="Email">Email:</label>
		<div class="col-md-10">          
			<input type="text" class="form-control" id="Email" >
		</div>
	</div>
	
	
</div>
</td>
<td>
<!--  COL2 DIV START -->
<div id=' ' class='col-xs-6' >

	<div class="form-group">
		<label class="control-label col-md-2" for="DisciplineID">Discipline:</label>
		<div class="col-md-10">          
			<select name='DisciplineID' id='DisciplineID' class='form-control'>
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
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-2" for="Address1">Address1:</label>
		<div class="col-md-10">          
			<input type="text" class="form-control" id="Address1" >
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2" for="Address2">Address2:</label>
		<div class="col-md-10">          
			<input type="text" class="form-control" id="Address2" >
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2" for="Address3">Address3:</label>
		<div class="col-md-10">          
			<input type="text" class="form-control" id="Address3" >
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2" for="Address4">Address4:</label>
		<div class="col-md-10">          
			<input type="text" class="form-control" id="Address4" >
		</div>
	</div>
	
	
	<!--  location-->

	<div class="form-group">
		<label class="control-label col-md-2" for="City">City:</label>
		<div class="col-md-10">          
			<input type="text" class="form-control" id="City" >
		</div>
	</div>
	
	<!--  state dropdown -->
	<div class="form-group">
		<label class="control-label col-md-2" for="State">State:</label>
		<div class="col-md-10">          
		<select name='State' id='State' class='form-control'> 
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
		</select>
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-2" for="County">County:</label>
		<div class="col-md-10">          
			<input type="text" class="form-control" id="County" >
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-2" for="Country">Country:</label>
		<div class="col-md-10">          
			<input type="text" class="form-control" id="Country" >
		</div>
	</div>

	
	
	<!--  contact info -->
	
	Preferred method of contact:<br/> 
	<label for='CommMethod1'>Phone: </label><input type='checkbox' name='CommMethod1' id='CommMethod1' checked /><br/> 
	<label for='CommMethod2'>Email: </label><input type='checkbox' name='CommMethod2' id='CommMethod2' checked /><br/></br>
	
	<!--   button -->
	<input class='btn btn-primary' type='button' value='Add' name='add_button' id='add_button' onClick='checkStaff()' />
	<br/><br/> 
	
	
</div> <!--  col2 div -->
</td>
</table>




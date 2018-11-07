<?php

session_start();
// This is file that creates a form to edit employee information. The id is passed to the js function which passes it here. We select all the data and use it to fill out the form on the server end. When the user clicks submit the data is sent to update complete to update the caregiver file. 

//get the db
include '../init.php';

//used to run through all available disciplines
$disc = "SELECT * FROM DisciplineMaster ORDER BY Description ASC";

//save the id
$id = $_POST['id'];
/*
//get the username 
$sql = "Select UserName, AccountID FROM UserMaster WHERE TypeID= '$id' AND AccountType = 'staff'";
foreach($connection->query($sql) as $row) {
	$username = $row['UserName'];
}

$ssqqll = "SELECT * FROM UserSecurity WHERE AccountID = ". $row['AccountID'];
foreach($connection->query($ssqqll) as $row) {
	
	$role= $row['Role'];
	
	
	$security1 = $row['Security1'];
	$security2 = $row['Security2'];
	$security3 = $row['Security3'];
	
}*/

/*UserMaster.AccountID, UserMaster.AccountType, UserSecurity.Role,  UserSecurity.AccountID*/

$master = $connection->query("SELECT * FROM UserMaster WHERE AccountType = 'staff' AND TypeID = '$id'")->fetch();
$security = $connection->query("SELECT Role FROM UserSecurity WHERE AccountID = ". $master['AccountID'])->fetch();
	
$role = $security['Role'];





// get the rest of the info
$query = $connection->query("SELECT * FROM StaffMaster WHERE StaffID= '$id' ");    
$data = $query->fetch();


?>
<style>

label{
  margin: 25px 0 25px 25px;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

input[type='button'] {
  min-width: 150px;
  margin: 5px;
  
}

#save_status input[type='text'], #save_status input[type='password'], select {
  min-width: 50%;
  max-width: 50%;
  width: 50%;
}
/* Changed the cols up to fit appropriately*/
#col1 {
  width: 50%;
  margin: 0;
  padding: 0;
}
#col2 {
  width: 50%;
  margin: 0;
  padding: 0;
}
</style>

<div id='col1' name='col1' class='col-sm-6'>
	<p>Numbers</p><hr/><br/>
	Phone:	<input id="Phone" class="Phone" type="text" value="<?php echo $data['Phone']  ?>" ></input><br/>
	Fax:	<input id="Fax" class="Fax" type="text" value="<?php echo $data['Fax']  ?>" ></input><br/>
	Zip:	<input id="Zip" class="City" type="text" value="<?php echo $data['Zip']  ?>"  ></input>
	
	
	
	
	<?php if($_SESSION['user']['Role'] == 'admin2') { ?> <!-- ONLY ADMIN 2/SysAdmins can see roles! -->
	<p>Roles<hr/><br/>
	
	
		<select id="role" name="role" >
			<option value="" <?php if($role == '') { echo 'selected'; }  ?> >No role selected</option>
			<option value="staff" <?php if($role === 'staff') { echo 'selected'; }  ?> >Staff</option>
			<option value="admin1" <?php if($role === 'admin1') { echo 'selected'; }  ?> >Admin</option>
			<option value="admin2" <?php if($role === 'admin2') { echo 'selected'; }  ?> >System Admin</option>
		</select>
		
	</p>
	<br/><br/>
	
	<?php }?> <!-- PHP END IF -->
		
</div>
	
	
	
<div id='col2' name='col2' class='col-xs-6'>
	<p>Main Information</p><hr/><br/>
	<input id="StaffID" type="hidden" value="<?php echo $data['StaffID']  ?>" name="StaffID"></input>

	Middle:	<input id="MiddleName" class="MiddleName" type="text" value="<?php echo $data['MiddleName']  ?>"></input> <br/>
	
	Discipline: 
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
    	</select><br/>
	
		
	Address1:	<input id="Address1" class="Address1" type="text" value="<?php echo $data['Address1']  ?>"></input> <br/>
	
	Address2:	<input id="Address2" class="Address2" type="text" value="<?php echo $data['Address2']  ?>"></input> <br/>
	
	Address3:	<input id="Address3" class="Address3" type="text" value="<?php echo $data['Address3']  ?>"></input> <br/>
	
	Address4:	<input id="Address4" class="Address4" type="text" value="<?php echo $data['Address4']  ?>"></input> <br/>
	
	
	City:	<input id="City" class="City" type="text" value="<?php echo $data['City']  ?>"></input> <br/>
	
	State:	
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
		</select>			
	<br/>
	
	County:	<input id="County" class="County" type="text" value="<?php echo $data['County']  ?>"></input> <br/>
	
	Country:	<input id="Country" class="Country" type="text" value="<?php echo $data['Country']  ?>"></input> <br/>
		
	Email:	<input id="Email" class="Email" type="text" value="<?php echo $data['Email']  ?>"></input> <br/>
	
	<input id="CommMethod1" class="CommMethod1" type="checkbox" 
	<?php if( $data['CommMethod1'] == '1' ) {echo 'checked'; }  ?> 
	></input> 
	<label for='CommMethod1' > Phone </label> <br/>
	
	<input id="CommMethod2" class="CommMethod2" type="checkbox" 
	<?php if($data['CommMethod2'] == 'on' || $data['CommMethod2'] == 'true' || $data['CommMethod2'] == '1' ) {echo 'checked'; }  ?>
	></input> 
	<label for='CommMethod2' > Email </label> <br/><br/><br/>
	
	

	<input type="button" onclick="editStaff()" value="Edit"></input><br/>
	
	
	
	<?php if($_SESSION['user']['Role'] == 'admin2' ) : ?>
		<input type="button" onclick="clientCheck('<?php echo $data['StaffID']; ?>')" value="Delete"></input>
	<?php endif; ?>
	

</div> <!-- End col2 -- >
	



<?php
$connection = null;// close the db
?>
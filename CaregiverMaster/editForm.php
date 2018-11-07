<?php

// This is file that creates a form to edit Caregiver information. The id is passed to the js function which passes it here. We select all the data and use it to fill out the form on the server end. When the user clicks submit the data is sent to update complete to update the caregiver file. 

//get the db
include '../init.php';
//session_start();


//save the id
$id = $_POST['id'];

//statement for Caregiver data
$query = $connection->query("SELECT * FROM CaregiverMaster WHERE CaregiverID= '$id' ");
        
$data = $query->fetch();

?>

<!-- Original method - cy 10/7/15
<p style ='text-align: left; '>
	First:	<input id="FirstName" class="FirstName" type="text" value="<?php echo $data['FirstName'];  ?>" >  
	Middle:	<input id="MiddleName" class="MiddleName" type="text" value="<?php echo $data['MiddleName'];  ?>" >  
	Last:	<input id="LastName" class="LastName" type="text" value="<?php echo $data['LastName'];  ?>" >  <br/><br/>
</p>
taken out for now-->


<div id='col1' >
	
	Phone:	<input id="Phone" class="Phone" type="text"  value="<?php echo $data['Phone'];  ?>" > <br/>
	Fax:	<input id="Fax" class="Fax" type="text"   value="<?php echo $data['Fax'];  ?>" > <br/>
	Zip:	<input id="Zip" class="City" type="text" maxlength=5 value="<?php echo $data['Zip'];  ?>" >
	
</div>
	
	
	
<div id='col2' >

	Middle:	<input id="MiddleName" class="MiddleName" type="text" value="<?php echo $data['MiddleName']  ?>"></input> <br/>
	<input id="CaregiverID" type="hidden"  name="CaregiverID" value="<?php echo $data['CaregiverID']; ?>">
	
	
	Address1:	<input id="Address1" class="Address1" type="text" value="<?php echo $data['Address1'];  ?>" >  <br/>
	
	Address2:	<input id="Address2" class="Address2" type="text" value="<?php echo $data['Address2'];  ?>" >  <br/>
	
	Address3:	<input id="Address3" class="Address3" type="text" value="<?php echo $data['Address3'];  ?>" >  <br/>
	
	Address4:	<input id="Address4" class="Address4" type="text" value="<?php echo $data['Address4'];  ?>" >  <br/>
	
	
	City:	<input id="City" class="City" type="text" value="<?php echo $data['City'];  ?>" >  <br/>
	
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
	
	County:	<input id="County" class="County" type="text" value="<?php echo $data['County'];  ?>">  <br/>
	
	Country:	<input id="Country" class="Country" type="text" value="<?php echo $data['Country'];  ?>">  <br/>
		
	Email:	<input id="Email" class="Email" type="text" value="<?php echo $data['Email'];  ?>">  <br/>
	
	<input id="CommMethod1" class="CommMethod1" type="checkbox" 
	<?php if($data['CommMethod1'] == 'on' || $data['CommMethod1'] == 'true') {echo 'checked'; }  ?>
	></input> 
	<label for='CommMethod1' > Phone </label> <br/>
	
	
	<input id="CommMethod2" class="CommMethod2" type="checkbox" 
	<?php if($data['CommMethod2'] == 'on' || $data['CommMethod2'] == 'true') {echo 'checked'; }  ?>
	></input> 
	<label for='CommMethod2' > Email </label> <br/>	
	

	<input type="button" onclick="editCaregiver()" value="Edit" >
	
	<?php if( $_SESSION['user']['Role'] === 'admin2'): ?>
	<input type="button" onclick="deleteCaregiver('<?php echo $data['CaregiverID']; ?>')" value="Delete" >
	<?php endif; ?>

</div> <!-- End col2 -->


	



<?php
$connection = null;// close the db
?>
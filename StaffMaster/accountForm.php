<?php


// This is file that creates a form to edit employee information. The id is passed to the js function which passes it here. We select all the data and use it to fill out the form on the server end. When the user clicks submit the data is sent to update complete to update the caregiver file. 

// 11/23/15 MIGHT NOT NEED?!?!?!?

//get the db
include '../init.php';

//save the id
$id = $_POST['id'];

//get the username 
$sql = "Select * FROM UserMaster WHERE StaffID = '$id' ";
foreach($connection->query($sql) as $row) {
	$username = $row['UserName'];
}


// get the rest of the info
$query = $connection->query("SELECT * FROM StaffMaster WHERE StaffID= '$id' ");    
$data = $query->fetch();
?>
<link rel="stylesheet" href="http://www.thesaigroup.org/wp-admin/TeleSystem/main.css" />
<script type="text/javascript" src="http://www.thesaigroup.org/wp-admin/TeleSystem/StaffMaster/js/edit.js" ></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<h1>Account Settings</h1> 

<label for='Username'>Username: </label>
<input id='Username' type='text' value="<?php echo $username; ?>" />
<br/>

<label for=''> New Password   :</label>
<input id='password1' type='password'  value="" />
<br/>

<label for=''> Retype New Password:</label>
<input id='password2' type='password' value=""  />


<br/><br/><br/>





<h4>Security Questions </h4>

<br/><br/>

<select id='security1' onchange="securityQuestions('security1')" >
	<option value='' >Select a value</option>
	<option value='1' >What was the name of your elementry school?</option>
	<option value='2' >What was the name of your first pet?</option>
	<option value='3' >What is your mothers maiden name?</option>
	<option value='4' >What city were you born in?</option>
</select>

<br/>

<select id='security2' onchange="securityQuestions('security2')" >
	<option value='' >Select a value</option>
	<option value='1' >What was the name of your elementry school?</option>
	<option value='2' >What was the name of your first pet?</option>
	<option value='3' >What is your mothers maiden name?</option>
	<option value='4' >What city were you born in?</option>
</select>

<br/>

<select id='security3' onchange="securityQuestions('security3')" >
	<option value='' >Select a value</option>
	<option value='1' >What was the name of your elementry school?</option>
	<option value='2' >What was the name of your first pet?</option>
	<option value='3' >What is your mothers maiden name?</option>
	<option value='4' >What city were you born in?</option>
</select>

<br/>
<br/>
<br/>




<h4>Roles</h4>

<label for='view'>View: </label> <input id='view' name='view' type='checkbox' /><br/>
<label for='add'>Add: </label> <input id='add' name='add' type='checkbox' /><br/>
<label for='edit'>Edit: </label> <input id='edit' name='edit' type='checkbox' /><br/>
<label for='delete'>Delete: </label> <input id='delete' name='delete' type='checkbox' /><br/>

<br/><br/>
<input id='btnAccount' type='button' value='Edit Account' onclick='xxx' />
<br/>
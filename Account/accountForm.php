<?php
	include "../init.php"; //getdb
	
	//redirect if not logged in
	if(!isset($_SESSION['user'])) {
		header("Location: ../index.php");
	}
	//check to see if the logout has expired
	if( $_SERVER['REQUEST_TIME'] > $_SESSION['user']['timeout']) {
		header("Location: ../Account/logout.php");
	}
	
	$_SESSION['user']['timeout'] = $_SERVER['REQUEST_TIME'] + 1800;
	
	//find the account type data
	//STAFF
	if( $_SESSION['user']['AccountType'] == "staff") {
		$data = $connection->query("SELECT * FROM StaffMaster WHERE StaffID = ". $_SESSION['user']['TypeID'])->fetch();
	}
	//CARE
	if( $_SESSION['user']['AccountType'] == "care") {
		$data = $connection->query("SELECT * FROM CaregiverMaster WHERE CaregiverID= ". $_SESSION['user']['TypeID'])->fetch();
	}
	//PROVIDER
	if( $_SESSION['user']['AccountType'] == "prov") {
		$data = $connection->query("SELECT * FROM ProviderMaster WHERE ProviderID= ". $_SESSION['user']['TypeID'])->fetch();
	}
	
	//$usermaster = $connection->query("SELECT pwChange, pwExpire FROM UserMaster WHERE AccountID = ". $_SESSION['user']['AccountID'])->fetch();
	//if($user= $connection->query("SELECT Security1, Security2, Security3 FROM UserSecurity WHERE AccountID = ". $_SESSION['user']['AccountID'])->fetch())
	

	
	
	
	
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8"/>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
<script type="text/javascript" src="account.js"></script>
<link rel="stylesheet" href="http://www.thesaigroup.org/wp-admin/TeleSystem/main.css" />
<style>
	h3 { text-align: inherit; }
	
	
	//#save_status {text-align: right; }
	#contact { margin-right: 33%; }
	select {
	  //width: 100%;
	}
	
	input[type='button']:disabled, input[type='submit']:disabled  {
		text-decoration: line-through; 
		color: black;
	}
	#password1, #password2 {
		border: 1px solid white;
	}
	
	
	#address1, #address2, #address3, #address4 { 
	  margin: 0;
	} 
	
</style>

</head>


<!-- onload gives focus to the firstname textfield -->
<body>
<div id='wrapper'>
	
	<p style=" text-align: right;
  				margin-right: 20%;
 				background-color: #fff;">
 					<?php
				echo "Hello ". $_SESSION['user']{'UserName'} . ".";
			?>
			<a 
			href="http://www.thesaigroup.org/wp-admin/TeleSystem/Account/logout.php"
			>Logout</a>
	<?php include 'http://www.thesaigroup.org/wp-admin/TeleSystem/header.php'; ?> <!-- grab the default header -->
	
	<div id='content' >
		
		<h1 >Account</h1>
		
		
		<div name='save_status' id='save_status' >
		
		<?php if($_SESSION['user']['pwExpire'] < $_SERVER['REQUEST_TIME'] ) {
			echo "<div class='error'>Your password has expired. Please change your password now.</div>";
		} 
		?>
		
			<!-- ACCOUNT FORM -->
			
			<!--
			EMAIL
			PHONE
			FAX
			LOCATION
			PASSWORD
			SUCRITY QUESTIONS
			-->
			<div  >
			<form id='account_form' >
				<input type="hidden" name="AccountID" value="<?php echo $_SESSION['user']['AccountID']; ?>"/>
				<input type="hidden" name="TypeID" value="<?php echo $_SESSION['user']['TypeID']; ?>"/>
				<input type="hidden" name="AccountType" value="<?php echo $_SESSION['user']['AccountType']; ?>"/>
				
				<div id='col1' >
				<h3>Change Password</h3>
				Password Expires(
				<?php
					echo date('Y/m/d h:i a', $_SESSION['user']['pwExpire']  );
				?>
				)
				<br>
				Enter Password: <input type='password' id='password1' name="Password1" title="" /><br/>
				Retype Password: <input type='password' id='password2' name="Password2"  title="" /><br/>
				
				<input id='updateBtn' type='button' value='Update' onclick="validatePassword()" /><br/>
				<div id='error'></div>
				</div>
				
				<div id='col2'>
				<h3>Contact Information</h3>
				Phone: <input type='text' id='phone' name="Phone" value="<?php echo $data['Phone']; ?>" /><br/>
				Fax: <input type='text' id='fax' name="Fax" value="<?php echo $data['Fax']; ?>" /><br/>
				Email: <input type='text' id='email' name="Email" value="<?php echo $data['Email']; ?>" /><br/><br/><br/>
				
				Address<br>
				<input type='text' id='address1' name="Address1" value="<?php echo $data['Address1']; ?>" /><br/>
				<input type='text' id='address2' name="Address2" value="<?php echo $data['Address2']; ?>" /><br/>
				<input type='text' id='address3' name="Address3" value="<?php echo $data['Address3']; ?>" /><br/>
				<input type='text' id='address4' name="Address4" value="<?php echo $data['Address4']; ?>" /><br/><br/>
				
				City: <input type='text' id='city' name="City" value="<?php echo $data['City']; ?>" /><br/>
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
						<option value="NM" <?php if($data['State'] == 'NM') { echo 'selected'; }  ?> >New Mexico</option>
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
				</select> <br/>
				Zip: <input type='text' id='zip' name="Zip" value="<?php echo $data['Zip']; ?>" /><br/>
				County: <input type='text' id='county' name="County" value="<?php echo $data['County']; ?>" /><br/>
				Country: <input type='text' id='country' name="Country" value="<?php echo $data['Country']; ?>" /><br/><br/>
				</div>
				
				<!--
				<h3>Security Questions</h3>
				
				What was the name of your elementry school? <br/>
				<input id='security1' name='Security1' type='text' value="<?php echo $user['Security1']; ?>"/> 
				<br/>
				
				What city were you born in? <br/>
				<input id='security2' name='Security2' type='text' value="<?php echo $user['Security2']; ?>"/> 
				<br/>
				
				What was your first pets name? <br/>
				<input id='security3' name='Security3' type='text' value="<?php echo $user['Security3']; ?>" /> 
				<br/><br/><br/>
				-->

				
				
				<div id='message'></div>
			</form>
			</div> 
		</div>
		
		<br/><br/>
		
	</div> <!-- content -->
</div> <!-- wrapper -->


<?php include 'http://www.thesaigroup.org/wp-admin/TeleSystem/footer.php'; ?> <!-- grab the footer -->


<script>

$("#password1").on('input', function() {
	
	validatePasswords();
});

$("#password2").on('input', function() {
	
	validatePasswords();

});

function validatePasswords() {

	var one = $('#password1').val();
	var two = $('#password2').val();
	
	if( one !== two ) {
		$('#password1').css({"border-color": "#aa3333", 
            		 "border-width":"1px", 
            		 "border-style":"solid"});
            	$('#password2').css({"border-color": "#aa3333", 
            		 "border-width":"1px", 
            		 "border-style":"solid"});
		$('#error').html("Your passwords do not match");
		$('#updateBtn').prop('disabled', true);
		
	} else if( one.length < 8) {
		$('#password1').css({"border-color": "#aa3333", 
            		 "border-width":"1px", 
            		 "border-style":"solid"});
            	$('#password2').css({"border-color": "#aa3333", 
            		 "border-width":"1px", 
            		 "border-style":"solid"});
		$('#error').html("Your password is too short.");
		$('#updateBtn').prop('disabled', true);
	} else {
		
		$('#updateBtn').prop('disabled', false);
		$('#error').html("");
		$('#password1').css({"border": "none"});
		$('#password2').css({"border": "none"});
	}
	
	if( one ===  "" && two === "" ) {
		$('#updateBtn').prop('disabled', false);
		$('#error').html("");
		$('#password1').css({"border": "none"});
		$('#password2').css({"border": "none"});
	}
	
}

</script>
</body>
</html>

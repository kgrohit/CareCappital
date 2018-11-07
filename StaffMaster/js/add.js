// this is the function to print out the form. Its called IF the staff does not exist in the database. 
function addForm() {
	
	
	// how to add in the middle name between the first and last name inputs. 
	// MUST call the remove function to hide this field when not adding a user.
	//$('#middle-field').html(" Middle Name: <input id='MiddleName' class='MiddleName' type='text' />");
	
	
	// Using AJAX to GET data
	$.ajax({
	method: "POST",
	url: "http://www.thesaigroup.org/wp-admin/TeleSystem/StaffMaster/addForm.php"
	}).done(function(data) {
	//return the data 
	$('#save_status').html(data);
	$('#error').html("");
	
	});
	
	$('#LastName').focus();  // Focus the first text box
	
	


}


function checkStaff() {
	
	//removing the validation here and redirecting to the actual add method.
	addStaff();
	
	
}




// This uploads the data to the db.
function addStaff() {
	

	
	// save data to array
	var staff = {
		"id": $("#StaffID").val(),
		
		"first": $("#FirstName").val().trim(),
	
		"last": $("#LastName").val().trim(),
		
		
		"middle": $("#MiddleName").val().trim(),
		
		"disc": $("#DisciplineID").val(),
		
		
		"add1": $("#Address1").val(),
		"add2": $("#Address2").val(),
		"add3": $("#Address3").val(),
		"add4": $("#Address4").val(),
		
		"city": $("#City").val(),
		"state": $("#State").val(),
		"zip": $("#Zip").val(),
		"county": $("#County").val(),
		"country": $("#Country").val(),
		
		"phone": $("#Phone").val(),
		"fax": $("#Fax").val(),
		"email": $("#Email").val(),
		
		"com1": $("#CommMethod1").is(":checked"),
		"com2": $("#CommMethod2").is(":checked")
		
		
		
	};
	
	// stringify the staff array to its json format
	var json = JSON.stringify(staff);
	
		
	//POST json to hte page
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/StaffMaster/add.php",
		data: { json: json }
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
	
	});
	
	
	/*
	
	// old add form method
	
	//validate the pws and username. Then run the request
	if(validateUsername(username)){
		if(validatePassword(pwOne, pwTwo)){
			// Using AJAX to GET data
			$.ajax({
			method: "POST",
			url: "http://www.thesaigroup.org/wp-admin/TeleSystem/StaffMaster/add.php",
			data: {
				first: first,
				middle: middle,
				last: last,
				disc: disc,
				address1: address1,
				address2: address2,
				address3: address3,
				address4: address4,
				city: city,
				state: state,
				zip: zip,
				county: county,
				country: country,
				phone: phone,
				fax: fax,
				email: email,
				comm1: comm1,
				comm2: comm2,
				username: username,
				pw1: pwOne
			}
			}).done(function(data) {
				//return the data 
				$('#save_status').html(data);
				$('#error').html("");
			
			});
		} 
	} 
	*/
	
	



}



// validates for the USERMASTER TABLE
function validateUsername(user){
	
	if(user.length < 5 || user.length > 20 ){
		$('#error').html("Your username must have 5-20 characters.");
		return false;
	}
	
	if( /[^a-zA-Z0-9\-\/]/.test( user ) ) {
		$('#error').html("You cannot include special characters in your username.");
		return false;
	}
	
	return true;

}

function validatePassword(pwOne, pwTwo){
	if(pwOne != pwTwo ){
		$('#error').html("Your passwords don't match.");
		return false;
	}
	if(pwOne.length < 5 || pwOne.length > 20){
		$('#error').html("Your password must have 5-20 characters.");
		return false;
	}
	
	return true;
}
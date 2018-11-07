// This is the event that is called when you enter in a first/last name, and click the ADD button. Checks to see if that caregiver is already present in the database.

function checkCaregiver() {

	$('#error').html("");
	
	//get values
	var first = $('#FirstName').val();
	var last = $('#LastName').val();
	
	if( first != '' && last !='' ){
	
		//loading text
		$('#error').text("Loading...");
		
		console.log('check caregiver called');
		
		$.post('http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/addCheck.php', 
			{ first: first,
			last: last }, 
			function (data) {
				if (data === '') {
					addCaregiver();
				} else {
					$('#error').text('A user with that first and last name has already been entered.');
				}	
			
		});
	
	}else {
		$('#error').html("You must enter a first AND last name.");
	}
	
}


// this is the function to print out the form. Its called IF the caregiver does not exist in the database. 

function addForm() {

	
	// Using AJAX to GET data
	$.ajax({
		method: "GET",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/addForm.php"
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
		
	});


	// how to add in the middle name between the first and last name inputs. 
	// MUST call the remove function to hide this field when not adding a caregiver.
	
	// show the middle field
	$('#middle-field').html(" Middle Name: <input id='MiddleName' class='MiddleName' type='text' />");
	
	// give it focus
	$('#LastName').focus();
	
	//reset values for addAddress function
	//counter = 1;
	//limit = 4;
	
}


/* Alt Method - cy 11/18/15
// This uploads the data to caregiver.
function addCaregiver() {

	//get data
	var first = $('#FirstName').val();
	var middle = $('#MiddleName').val();
	var last = $('#LastName').val();
	
	var address1 = $('#Address1').val();
	var address2 = $('#Address2').val();
	var address3 = $('#Address3').val();
	var address4 = $('#Address4').val();
	
	var city = $('#City ').val();
	var state = $('#State').val();
	var zip = $('#Zip').val();
	var county = $('#County').val();
	var country = $('#Country').val();
	
	var phone = $('#Phone').val();
	var fax = $('#Fax').val();
	var email = $('#Email').val();
	
	var comm1 = $('#CommMethod1').is(':checked'); // copied these 2 statements from ProviderMaster - cy 9/30/15
	var comm2 = $('#CommMethod2').is(':checked');
	
 	/*  old method, might not need - cy 9/30/15 
	
	if ($('#CommMethod1').is(':checked')) {
		var comm1 = 'on'; 
	}
	
	if ($('#CommMethod2').is(':checked')) {
		var comm2 = 'on'; // change from 'on' to 'true', method1 to comm1, method2 to comm2
	}
	*/
	/*
		
	//loading text
	$('#save_status').text("Loading...");
	

	// post the variables
	$.post('http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/add.php', {
		first: first,
		middle: middle,
		last: last,
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
		com1: comm1,
           	com2: comm2 //change method1 & method2 to comm1 and comm2
	}, 
	function (data) {
		$('#save_status').text(data);
		$('#error').text('');
	});



 	//loading text
   	$('#error').text("Loading...");

	// Using AJAX to POST data
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/add.php",
		data: {
	
			first: first,
			middle: middle,
			last: last,
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
			com1: comm1,
	           	com2: comm2 //change method1 & method2 to comm1 and comm2
		}
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
		
	});
	
}
*/

// This uploads the data to caregiver.
function addCaregiver() {

	$('#error').text('');

	var data = {

		//get data
		"first": $('#FirstName').val(),
		"middle": $('#MiddleName').val(),
		"last": $('#LastName').val(),
		
		"address1": $('#Address1').val(),
		"address2": $('#Address2').val(),
		"address3": $('#Address3').val(),
		"address4": $('#Address4').val(),
		
		"city": $('#City ').val(),
		"state": $('#State').val(),
		"zip": $('#Zip').val(),
		"county": $('#County').val(),
		"country": $('#Country').val(),
		
		"phone": $('#Phone').val(),
		"fax": $('#Fax').val(),
		"email": $('#Email').val(),
		
		"com1": $("input:checkbox[name ='CommMethod1']:checked").val(),
		"com2": $("input:checkbox[name ='CommMethod2']:checked").val()
		
	}
	
	
	var json = JSON.stringify(data);
		
	
	//POST json to hte page
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/add.php",
		data: { json: json }
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
	
	});
	

}
	
	
	
	
	
	
	
	
	
	
		
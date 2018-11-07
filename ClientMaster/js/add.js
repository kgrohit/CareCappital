/*
	This is the add.js file for ClientMaster. 
	Like the other add.js files it controls the function of displaying the add form to the user 
	and adding that information to the clientmaster table.
	Also includes any validation.
*/

// This is called when the user clicks add. It opens the form to enter the rest of the patients information in.
function addForm() {

	loading();
	// Using AJAX to GET data
	$.ajax({
		method: "GET",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/ClientMaster/addForm.php"
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
		stopLoading();
		
	});


	// how to add in the middle name between the first and last name inputs. 
	// MUST call the remove function to hide this field when not adding a client.
	
	// show the middle field
	$('#middle-field').html(" Middle Name: <input id='MiddleName' class='MiddleName' type='text' />");
	
	// give the first name focus
	$('#LastName').select();
	
        
}



// validations

function checkClient() {

	
	$('#error').html("");
	
	//get values
	var first = $('#FirstName').val();
	var last = $('#LastName').val();
	
	if( first != '' && last !='' ){
	
				
		$.post('http://www.thesaigroup.org/wp-admin/TeleSystem/ClientMaster/addCheck.php', 
			{ first: first,
			last: last }, 
			function (data) {
				if (data === '') { // if data === null then nothing was found in db
					addClient();
				} else {
					$('#error').text('A user with that first and last name has already been entered.');
				}	
			
		});
	
	}else {
		$('#error').html("You must enter a first AND last name.");
	}
	
	
	
	
}

// Uploads data to the table
function addClient() {
	

	$('#error').text('');
	
	var phonecall = ""; 
	
	phonecall += $('#Mon').is(':checked') ? $('#Mon').val() + " " : ''; 
	phonecall += $('#Tue').is(':checked') ? $('#Tue').val() + " " : ''; 
	phonecall += $('#Wed').is(':checked') ? $('#Wed').val() + " " : ''; 
	phonecall += $('#Thu').is(':checked') ? $('#Thu').val() + " " : ''; 
	phonecall += $('#Fri').is(':checked') ? $('#Fri').val() + " " : ''; 
	phonecall += $('#Sat').is(':checked') ? $('#Sat').val() + " " : ''; 
	phonecall += $('#Sun').is(':checked') ? $('#Sun').val() + " " : ''; 
	
	phonecall = phonecall.trim();
	

	var data = { 
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
		
		"dob": $('#DOB').val(),
		"dateProgInit": $('#DateProgInit').val(),
		
		
		"gender":  $("input:radio[name ='Gender']:checked").val(),
		
		"provider1": $('#Provider1').val(),
		"provider2": $('#Provider2').val(),
		"caregiver1": $('#Caregiver1').val(),
		"caregiver2": $('#Caregiver2').val(),
		
		"diagnosis1": $('#Diagnosis1').val(),
		"diagnosis2": $('#Diagnosis2').val(),
		"diagnosis3": $('#Diagnosis3').val(),
		"diagnosis4": $('#Diagnosis4').val(),
		
		"startDate": $('#startDate').val(),
		"endDate": $('#endDate').val(),
		"phoneFreq": phonecall,
		"timeToCall": $('#timeToCall').val(),
		"ampm": $("input:radio[name ='timeToCall']:checked").val(),
		"timezone": $('#timezone').val(),
		
		"StaffID": $('#StaffID').val(),
		"clientSchedule": $("input:radio[name ='clientSchedule']:checked").val(),
		"staffSchedule": $("input:radio[name ='staffSchedule']:checked").val(),
		"care1Schedule": $("input:radio[name ='care1Schedule']:checked").val(),
		"care2Schedule": $("input:radio[name ='care2Schedule']:checked").val(),
		"provider1Schedule": $("input:radio[name ='provider1Schedule']:checked").val(),
		"provider2Schedule": $("input:radio[name ='provider2Schedule']:checked").val(),
	}

	
	var json = JSON.stringify(data);
	
	
	
	//POST json to hte page
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/ClientMaster/add.php",
		data: { json: json }
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
	
	});
	

}

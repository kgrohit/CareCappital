function resetPassword() {

	/*===================================
	This program post the email variable to the page it was already on.
	If the query finds the email it prompts the user to enter their security questions. 
	...to be continued.
	===================================*/
	var email = $('#Email').val();
	
	$('#error').html("Loading...");

	
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/Password/securityQuestions.php",
		data: { Email: email }
	}).done(function(data) {
		if(data != false ) {
			$('#save_status').html(data);
			$('#save_status').append("<br/><div id='error'>Error</div>");
			$('#error').html("");
		} else {
			$('#error').html("Email is not registered.");
		}
	});
}

function goBack(email, attempts) {
	/*===================================
	
	This function handles a button to return the user to the homepage in the event that 'shit hits the fan'
	
	===================================*/
	
	if( attempts <= 3) {
		$.ajax({
			method: "POST",
			url: "http://www.thesaigroup.org/wp-admin/TeleSystem/Password/securityQuestions.php",
			data: {Email: email, attempts}
		}).done(function(data) {
			$('#save_status').html(data);
			
		});
	} else {
		//if the user tries to reset three times. Present an error.
		$('#save_status').html("This email is locked out. Please contact admin support or wait 24 hours to reset your password.");
	}
}

function submitAnswers( id, email) {


	/*=============================
	This takes the id and email parameters and the inputs you gave for security questions 1-3 and posts them to a page to validate the answers.
	=============================*/
	
	//array of data
	var reset = {
		"id": id,
		"email": email,
		"answer1": $('#security1').val(),
		"answer2": $('#security2').val(),
		"answer3": $('#security3').val(),
		"attempts": $("#attempts").val()
	};
	
	// set the array to json format
	var json = JSON.stringify(reset);
	
	
	//post it to the resetPw.php
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/Password/resetPw.php",
		data: { data: json }
	}).done(function(data) {
		$('#save_status').html(data);
		
	});
	
	
}


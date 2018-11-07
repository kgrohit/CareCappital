
function editform(id, first, last) {

    first = first.trim();
    last = last.trim();

    // Set the first and last name to the search boxes
    $('#FirstName').val(first);
    $('#LastName').val(last);
    
    

    //loading text
    $('#error').val("Loading...");


    // Using AJAX to POST DATA
    $.ajax({
        method: "POST",
        url: "http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/editForm.php",
        data: {
            id: id
        }
    }).done(function(data) {
        $('#save_status').html(data);
        $('#error').val("");

    });

}




function editCaregiver() {

   $('#error').text('');

	var data = {

		//get data
		"id": $('#CaregiverID').val(),
		"first": $('#FirstName').val().trim(),
		"middle": $('#MiddleName').val().trim(),
		"last": $('#LastName').val().trim(),
		
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
				
		"com1": $("#CommMethod1").is(":checked"),
		"com2": $("#CommMethod2").is(":checked")
		
	};
	
	
	var json = JSON.stringify(data);
		
	// Alt method, cy - 11/23/15	
	//POST json to hte page
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/editComplete.php",
		data: { json: json }
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
	
	});

 		

}





	
	
	
	
	
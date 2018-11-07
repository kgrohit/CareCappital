// This is the event that is called when you enter in a first/last name, and click the ADD button. Checks to see if that staffmember is already present in the database.

function checkProvider() {
	
	$('#error').html("");
	
	//get values
	var first = $('#FirstName').val();
	var last = $('#LastName').val();
	
	
	
	//loading text
	$('#error').text("Loading...");
	
	$.post('http://www.thesaigroup.org/wp-admin/TeleSystem/ProviderMaster/addCheck.php', 
		{ first: first,
		last: last }, 
		function (data) {
			if (data === '') {
				addProvider();
			} else {
				$('#error').text(data);
				console.log(data);
			}	
		
	});
	
	
	

}


// this is the function to print out the form. Its called IF the staff does not exist in the database. 

function addForm() {


    // how to add in the middle name between the first and last name inputs. 
    // MUST call the remove function to hide this field when not adding a user.
    $('#middle-field').html(" Middle Name: <input id='MiddleName' class='MiddleName' type='text' />");


    	// Using AJAX to GET data
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/ProviderMaster/addForm.php"
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
		
	});
	
	$('#LastName').focus();  // Focus the first text box
	

	

}



// This uploads the data to the db.
function addProvider() {

    //get data
    var first = $('#FirstName').val().trim();
    var middle = $('#MiddleName').val().trim();
    var last = $('#LastName').val().trim();
    
    var disc = $('#DisciplineID').val();

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

    var comm1 = $('#CommMethod1').is(':checked');
    var comm2 = $('#CommMethod2').is(':checked');





    //loading text
    $('#error').text("Loading...");


    
    // Using AJAX to POST data
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/ProviderMaster/add.php",
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
		        comm2: comm2
		}
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
		
	});


	

}
function addForm(){
	
	$('#error').html('Loading...');
	
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/addForm.php"
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
		$('#description').focus();
		
	});

}

// Add the checkDiagnosis - Chia Yang 9/23/15
// This is the event that is called when you enter a new diagnosis, and click the ADD button. Checks to see if that diagnosis is already present in the database.

function checkDiagnosis() {

	$('#error').html("");
	
	//get values
	var desc = $('#description').val();
	
	
	if( desc != '' ){
	
		//loading text
		$('#error').text("Loading...");
		
		
		
		// post the variable		
		$.post('http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/addCheck.php', { 
			desc:desc 
		}, 
			
			function (data) {
				if (data === '') {
					addDiagnosis();
				} 
				else {
				$('#error').text('A diagnosis with that discription has already been entered.');
				}	
			
		});
	
	}else {
		$('#error').html("You must enter a valid description.");
	}
	
}




function addCheck(){

	$('#error').html('Loading...');
	
	var desc = $('#description').val();
	if(desc !== '' ){
		$.ajax({
			method: "POST",
			url: "http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/addCheck.php",
			data: {
				desc: desc
			}
		}).done(function(data) {
			//return the data 
			
			addDiagnosis();
			$('#error').html("");
			
		});
	} else{
		$('#error').html("You must enter a name in.");
	}
	

}




function addDiagnosis(){
	
	var desc = $('#description').val();
	var r = confirm("Do you want to add this Diagnosis to the database?");
	
	if(r){
		$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/add.php",
		data: {
			desc: desc
		}
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
		
	});
	}

}
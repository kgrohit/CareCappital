/*
function deleteDiagnosis(){

	var icd = $('#icd').val();
	
	// var r = ('Do you really want to delete this Diagnosis? (Cannot be undone)'); // took out word_confirm
	
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/checkClient.php",
		data: { icd: icd }
	}).done(function(data) {
		if(data === null){
		  // put new ajax request in.
		  $('#error').html("Okay to Delete.");
		} else{
			$('#error').html(data);
			
		}
	});
	/*
		if(r){  // check to see if the user confirms the decision
			$.ajax({
				method: "POST",
				url: "http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/delete.php",
				data: {
					icd: icd
				}
			}).done(function(data) {
				//return the data 
				$('#save_status').html(data);
				$('#error').html("");
				
			});
			
		}// if(r)*/
/*	
} //delteDisc

*/


function deleteDiagnosis(id) {


 	
	// If it is okay to delete the provider you confirm the deletion with a popup
	var r = confirm("Do you really want to delete this provider?");

	if(r){
	
		$.post('http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/delete.php', 
	    	  	{id: id}, 
	        	function(data) {
	        		
				if(data != '' ){
					$('#save_status').html(data);
					$("#error").html("");
				} 
				else {
					document.getElementById('save_status').innerHTML = "Error";
				}
			});
	
		} 
			
}
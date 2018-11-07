function deleteStaff(ID){


	var staff = {
		"id": ID
	}
	
	var json = JSON.stringify(staff);
	
	var r = confirm("Do you really want to delete this staff member?");
	
	if(r) {

	        //loading text
		$('#save_status').text("Loading...");
	        
	        $.post('http://www.thesaigroup.org/wp-admin/TeleSystem/StaffMaster/deleteStaff.php', 
	        	{json: json}, 
	        	function(data) {			
				/*if(data != '' ){
					$('#save_status').html(data);
				} else {
					document.getElementById('save_status').innerHTML = "JS Error";
				}*/
				$('#save_status').html(data);
		});
	}

}

function clientCheck(id) {


	var staff = {
		"id": id
	}
	
	var json = JSON.stringify(staff);
	
	$.ajax({
	  method: "POST",
	  url: "http://www.thesaigroup.org/wp-admin/TeleSystem/StaffMaster/checkClient.php",
	  data: { json: json }
	}).done(function( data ) {
	   	if(data === "" ) {
			deleteStaff(id);
	   	} else {
	   		$('#error').html(data);
	   	}
	   	
	  });
}
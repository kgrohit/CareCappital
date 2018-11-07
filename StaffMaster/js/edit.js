function editform(staffid, first, last){

	
	$('#FirstName').val(first);
	$('#LastName').val(last);
	
	
        //loading text
	$('#save_status').text("Loading...");
        
        $.post('http://www.thesaigroup.org/wp-admin/TeleSystem/StaffMaster/editForm.php', 
        	{id: staffid}, 
        	function(data) {
        		
		
			if(data != '' ){
				$('#save_status').html(data);
			} else {
				document.getElementById('save_status').innerHTML = "User could not be found.";
			}
	});
	
}


function editStaff(){  



	//json array or just array idk
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
		"com2": $("#CommMethod2").is(":checked"),
		
		"username": $("#Username").val(),
		"pwOne": $("#password1").val(),
		"pwTwo": $("#password2").val(),
		
		"security1": $('#security1').val(),
		"security2": $('#security2').val(),
		"security3": $('#security3').val(),
		
		"role": $("#role").val()
	
	};
	
	// stringify the staff array to its json format
	var json = JSON.stringify(staff);
	
		
	//shortens up the post function. Now we just have to post the json array
	$.post('http://www.thesaigroup.org/wp-admin/TeleSystem/StaffMaster/editComplete.php', 
        	{ json:json },
        	function(data) {
      			$('#save_status').html(data);
      		}
      	);
	
	
		/*=====================================
			TODO
		
		We should remove the check if null validations on frontend. 
		Change them so that if the variable on the post side is null we don't use it. 
		Not 100% sure on how its going to work.
		
		include the username/password validation
		Move to checkstaff? function?
		
		
		AL
		=====================================*/
		


} 



function accountForm(id){

 	//loading text
	$('#save_status').text("Loading...");
        
        $.post('http://www.thesaigroup.org/wp-admin/TeleSystem/StaffMaster/accountForm.php', 
        	{id: id}, 
        	function(data) {
			if(data != '' ){
				$('#save_status').html(data);
			} else {
				document.getElementById('save_status').innerHTML = "User could not be found.";
			}
	});

}

function ResetPassword(id) {

	var type = "staff";
	
	$.ajax({
		method: "POST",
		url: "../Account/resetPw.php",
		data: {id: id, type: type }
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);		
	});
}


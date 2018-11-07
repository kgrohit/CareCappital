function addForm(){
	
	$('#error').html('Loading...');
	
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/DisciplineMaster/addForm.php"
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
		$('#description').focus();
		
	});

}



function addDiscipline(){
	
	var desc = $('#description').val();
	var r = confirm("Do you want to add this Discipline to the database?");
	
	if(r){
		$.ajax({
			method: "POST",
			url: "http://www.thesaigroup.org/wp-admin/TeleSystem/DisciplineMaster/add.php",
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
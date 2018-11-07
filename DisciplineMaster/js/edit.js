function editForm(id){

    //loading text
    $('#error').val("Loading...");


    // Using AJAX to POST DATA
    $.ajax({
        method: "POST",
        url: "http://www.thesaigroup.org/wp-admin/TeleSystem/DisciplineMaster/editForm.php",
        data: {
            id: id
        }
    }).done(function(data) {
        $('#save_status').html(data);
        $('#error').html("");

    });

}
function editDiscipline(){
	var discID = $('#discID').val();  
	var desc = $('#description').val();
	
	//loading text
	$('#error').text("Loading...");

	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/DisciplineMaster/edit.php",
		data: {
		    id: discID,
		    desc: desc
		}
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
	
	});
}
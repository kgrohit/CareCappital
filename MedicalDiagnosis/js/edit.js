function editForm(id){

    //loading text
    $('#error').val("Loading...");


    // Using AJAX to POST DATA
    $.ajax({
        method: "POST",
        url: "http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/editForm.php",
        data: {
            id: id
        }
    }).done(function(data) {
        $('#save_status').html(data);
        $('#error').html("");

    });

}
function editDiagnosis(){
	var icd = $('#icd').val();
	var desc = $('#description').val();
	
	//loading text
	$('#error').text("Loading...");
	
	console.log(icd);
	console.log(desc);

	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/edit.php",
		data: {
		    icd: icd,
		    desc: desc
		}
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
	
	});
}
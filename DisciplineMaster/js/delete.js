/* Original Method take out - cy 10/7/15
// Delete function. Grabs the ID passed in the parameters and posts it to the deleteDiscipline.php page to be removed.

function deleteDiscipline(){
	
	var discID = $('#discID').val();
	
	console.log(discID);
	//prompt to prevent accidental deletions
	//var r = confirm("Are you sure you wish to delete this user?");
	
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/DisciplineMaster/staffCheck.php",
		data: { ID: discID }
	}).done(function(data) {
		if(data === ""){
			$('#error').html("You can delete a discipline.");
		}else {
			$('#error').html("You can't delete this discipline.");
		}
		
	});
		
/* this code will only run IF the user clicks yes

	var discID = $('#discID').val();
	
	var r = confirm('Do you really want to delete this Discipline?<br/>(Cannot be undone)');
	
	if(r){  // check to see if the user confirms the decision
		$.ajax({
			method: "POST",
			url: "http://www.thesaigroup.org/wp-admin/TeleSystem/DisciplineMaster/delete.php",
			data: {
				id: discID
			}
		}).done(function(data) {
			//return the data 
			$('#save_status').html(data);
			$('#error').html("");
			
		});
		
	}// if(r) */
/*	
} //deleteDisc 

*/


function deleteDiscipline(discID){

	
 	
	// If it is okay to delete the discipline you confirm the deletion with a popup
	var r = confirm("Do you really want to delete this discipline?");

	
	
	if(r) {
	
		
		$.ajax({
			method: "POST",
			url: "http://www.thesaigroup.org/wp-admin/TeleSystem/DisciplineMaster/delete.php",
			data: {
				id: discID
			}
		}).done(function(data) {
			//return the data 
			$('#save_status').html(data);
			$('#error').html("");
			
		});
	
	} // if the user selects cancel, the discipline will not be deleted.
	
	
	
	
	
	
			
}

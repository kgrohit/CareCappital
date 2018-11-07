/*
	delete.js  handles the button function from the 
*/
function deleteClient(){

	var ID = $('#ClientID').val();
	
	//prompt to prevent accidental deletions
	var r = confirm("Are you sure you wish to delete this user?");
	
	//this code will only run IF the user clicks yes
	if(r){
	
	        //loading text
		$('#save_status').text("Loading...");
	        
	        //post
	        $.post('http://www.thesaigroup.org/wp-admin/TeleSystem/ClientMaster/delete.php', 
	        	{ID: ID}, 
	        	function(data) {
	        		
				if(data != '' ){
					$('#save_status').html(data);
					$('#FirstName').html('');
					$('#LastName').html('');
				} else {
					document.getElementById('save_status').innerHTML = "Error";
				}
		});
	}
}
/* Original deleteCaregiver method taken out - cy 10/7/15

// Delete function. Grabs the ID passed in the parameters and posts it to the deleteCaregiver.php page to be removed.

function deleteCaregiver(ID){

	//prompt to prevent accidental deletions
	//var r = confirm("Are you sure you wish to delete this user?");
	
	$.post('http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/clientCheck.php', 
	        	{ID: ID}, 
	        	function(data) {
	        		
				if(data === '' ){
					$("#error").html("You can delete this caregiver.");
				} else {
					$("#error").html("A client is registered with this caregiver.");	
				}
		});
		
	
	/* this code will only run IF the user clicks yes
	if(r){
	
	        //loading text
		$('#save_status').text("Loading...");
	        
	        //post
	        $.post('http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/deleteCaregiver.php', 
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
	} */
	
/*	
}

*/



function deleteCaregiver(ID){


 	/*====================================
 	Finalized delete function: 
 	
 	This program serves two purposes. 
 	The first is to check if the caregiver is registered with a client in the ClientMaster Table.
 	If not the program will confirm that the user wishes to delete this Caregiver.
 	The program will NOT let the user delete a registered caregiver.
 	
 	Coty Crosby 10-1-15
 	====================================*/
	
	// Client check php checks if  the caregiver has been registered with  a client.
	$.post('http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/clientCheck.php', 
        	{ID: ID}, 
	        	function(data) {
        			// If checkclient finds a match, it will echo the first name of the client that has this caregiver.
				if(data === '' ){
				
					//loading text
					$('#error').text("Loading...");
					
					// If it is okay to delete the caregiver you confirm the deletion with a popup
					var r = confirm("Do you really want to delete this caregiver?");
					
					if(r){
					
						$.post('http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/deleteCaregiver.php', 
					        	{ID: ID}, 
					        	function(data) {
					        		
								if(data != '' ){
									$('#save_status').html(data);
									$("#error").html("");
								} else {
									document.getElementById('save_status').innerHTML = "Error";
								}
						});
					
					} // if the user selects cancel, the provider will not be deleted.
					
				} else {
					$("#error").html("A client has been registered with this Caregiver.");	
					
				}
			});
			
}
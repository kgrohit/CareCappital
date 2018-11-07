function deleteProvider(ID){


 	/*====================================
 	Finalized delete function: 
 	
 	This program serves two purposes. 
 	The first is to check if the provider is registered with a client in the ClientMaster Table.
 	If not the program will confirm that the user wishes to delete this Provider.
 	The program will NOT let the user delete a registered provider.
 	
 	Coty Crosby 10-1-15
 	====================================*/
		
	// Client check php checks if  the provider has been registered with  a client.
	$.post('http://www.thesaigroup.org/wp-admin/TeleSystem/ProviderMaster/clientCheck.php', 
        	{ID: ID}, 
	        	function(data) {
        			// If checkclient finds a match, it will echo the first name of the client that has this provider.
				if(data === '' ){
				
					//loading text
					$('#error').text("Loading...");
					
				
					
					// If it is okay to delete the provider you confirm the deletion with a popup
					var r = confirm("Do you really want to delete this provider?");
					
					if(r){
					
						$.post('http://www.thesaigroup.org/wp-admin/TeleSystem/ProviderMaster/delete.php', 
					        	{ID: ID}, 
					        	function(data) {
					        		
								if(data != '' ){
									$('#save_status').html(data);
									$("#error").html("");
								} else {
									document.getElementById('save_status').innerHTML = "Error";
								}
						});
					
					} else { // if the user selects cancel, the provider will not be deleted.
						$('#error').text("");
					}
				} else {
					$("#error").html("A client has been registered with this provider.");	
					
				}
			});
			
}
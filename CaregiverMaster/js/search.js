function searchForm(){

	loading();
	var search = {
		
		"first": $("#FirstName").val(),
	
		"last": $("#LastName").val(),
		
	 	"page": $('#page').val(),
		
		"rows": $('#rows').val()
		
	};
	
	// stringify the staff array to its json format
	var json = JSON.stringify(search);
	
	$.ajax({
	  method: "POST",
	  url: "http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/search.php",
	  data: { json: json }
	}).done(function( data ) {
	
	   	//set the data inside the save_status div
	   	$('#save_status').html(data);
	   	
	   	$('#LastName').focus();		//focus the last name
	   	$("#LastName").val("") ;	//clear the name text boxes
	   	$("#FirstName").val("") ;
	   	stopLoading();
	   	
	   	if(data === "" ) {
	   		$("#save_status").html("User does not appear in our database.");
	   	}
	  });
	  
}
	


/*

MOVING PAGES
	
	This controls the movement of page buttons forwards and back. 
	
	They initialize two variables, the current page and the last page. 
	
	Forward checks to see if the current page is with the proper range ( 1-last)
	Backward checks to see if the current page is greater than one. 
	This way we prevent array out of bounds errors.
	
	This validation is also done server side.	
	
*/


function forwards(){
	//init vars
	var last = parseInt($('#lastpage').val());
	var page = parseInt($('#page').val());
	
	console.log("Page is " + page);
	console.log("Last is " + last );
	//check page
	if (page < last ) {
		page = page + 1; // increment
		$('#page').val(page); // reset the page
		searchForm(); // start the search function
	}
	
	
}

function backwards(){
	
	//init var
	var page = parseInt($('#page').val());
	
	//check page
	if( page > 1) {

		page -= 1; //decrement
		$('#page').val(page);// edit page
		searchForm(); //start search function
	}	
	
	
}

function setPage(page){
	$('#page').val( page );
	searchForm();
}

/*

	Clearing 
*/

function clearNames(){
'use strict';
	$('#FirstName').val("");
	$('#middle-field').html("");
	$('#LastName').val("");
	$('#error').html("");
	$('#LastName').focus();
	searchForm();
}
/*

	Background Loading
	
*/

/*

	Background Loading
	
*/

function loading() {
	$('#thehead').fadeTo("fast", 0.5, function(){

	});
	
	$('#save_status').fadeTo("fast", 0.5, function(){

	});
	
	
}

function stopLoading(){
	$('#thehead').fadeTo("fast", 1, function(){

	});
	
	$('#save_status').fadeTo("fast", 1, function(){

	});

}



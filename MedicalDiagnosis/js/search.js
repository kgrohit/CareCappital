function search(){
	//page is the current page, rows is how many results are displayed.
	var page = $('#page').val();
	var rows = $('#rows').val();	
	
	//post it to the search php file.
	$.post(	'http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/search.php', 
	 	{ page: page, rows: rows },
		function (data) {
			$('#save_status').html(data);
			$('#error').html("");	
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

/* Alternative Method, might not need. cy - 11/2/15

function forwards(){
	//init vars
	var last = parseInt($('#last').val());
	var page = parseInt($('#page').val());
	
	//check page
	if (page < last ) {
		page = page + 1; // increment
		$('#page').val(page); // reset the page
		search(); // start the search function
	}
	
	
}

function backwards(){
	
	//init var
	var page = parseInt($('#page').val())
	
	//check page
	if( page > 1) {

		page -= 1; //decrement
		$('#page').val(page);// edit page
		search(); //start search function
	}	
	
}

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
		search(); // start the search function
	}
	
	
}

function backwards(){
	
	//init var
	var page = parseInt($('#page').val())
	
	//check page
	if( page > 1) {

		page -= 1; //decrement
		$('#page').val(page);// edit page
		search(); //start search function
	}	
	
	
}

function setPage(page){
	$('#page').val( page );
	search();
}

/*

	Clearing 
*/




/*  Might use this function for a clear button.

function clearNames(){
'use strict';
	$('#FirstName').val("");
	$('#middle-field').html("");
	$('#LastName').val("");
	$('#error').html("");
	$('#FirstName').focus();
	search();
}
*/

/*

	Background Loading
	
*/

function loading() {
	$("#wrapper").fadeTo(.5);
	$('#loader').append('<img src="ajax-loader.gif" />');
}

function stopLoading(){
	$('#wrapper').fadeTo(1);
	$('#loader').html("");
}


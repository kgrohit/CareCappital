/* ======================================

	CMS Things

 ====================================== */
 
var addDay = function() {
	
	resetDatepicker();
	var date = $('#SelectDate').datepicker('getDate');
	var today = new Date();
	
	if( date < (today.getTime() - (1000*60*60*24) ) ){
		
		if(date === ''|| date == '' || date === null ) { clearSearchFields(); }
		date.setTime(date.getTime() + (1000*60*60*24));
		$('#SelectDate').datepicker('setDate', date);
		
		search();
	}
}

var subtractDay = function() {

	resetDatepicker();
	var date = $('#SelectDate').datepicker('getDate');
	
	if(date === ''|| date == '' || date === null ) { clearSearchFields(); }
	
	date.setTime(date.getTime() - (1000*60*60*24));
	
	$('#SelectDate').datepicker('setDate', date);
	
	search();
}
 
function editForm(id ) {

	
	//Individual account page
	//displays client info, emergency contact info and bioreadings
	$.ajax({
		method: "POST",
		url: "patient.php",
		data: {id:id}
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");
		
		$('#btnSearch').attr('Value', 'Go Back'); //button text handling
	});
	

	
}

function SkipToEditBio(id, date) {


	$.ajax({
	
		method: "POST",
		url: "patient.php",
		data: {id:id},
		success: function(data) {
			$('#save_status').html(data);
			$('#error').html("");
		
			$('#btnSearch').attr('Value', 'Go Back'); //button text handling

		}
	}).done(function() {
		editBio(id, date);
		//return the data 
		
		


	});
}



function search() {
	
	var option = $("#SearchBy").val();
	
	
	$('#loader').html("<img src='../images/ajax-loader.gif' style=''/>");
	if(option === "Date"){
	
		var search = {
		"select": $('#SelectDate').val()
		}
		
	
		
		var json = JSON.stringify(search);
		
		/* CHANGED TO NEW SEARCH FUNCTION TAKE OUT NEW TO GO BACK TO OLD */
		$.ajax({
			method: "POST",
			url: "searchDate.php",
			data: {json: json}
		}).done(function(data) {
			$('#save_status').html(data);
			$('#error').html("");
			$('#btnSearch').attr('Value', 'Refresh');
			$('#loader').html("");
			
		});
	}
	
	if(option === "Provider"){
	
		var search = {
		  "provider": $("#providers").val(),
		  "function": "getClients"
		 
		};
		
		var json = JSON.stringify(search);
		
		$.ajax({
			method: "POST",
			url: "searchProvider.php",
			data: {json: json}
		}).done(function(data) {
			//return the data 
			$('#save_status').html(data);
			$('#error').html("");
			$('#btnSearch').attr('Value', 'Refresh');
			$('#loader').html("");
			
		});
	}
	
	
	if(option === "Patient"){
		var search = {
		  "first": $("#FirstName").val(),
		  "last": $("#LastName").val()		 
		};
		
		var json = JSON.stringify(search);
		
		$.ajax({
			method: "POST",
			url: "searchPatient.php",
			data: {json: json}
		}).done(function(data) {
			//return the data 
			$('#save_status').html(data);
			$('#error').html("");
			$('#btnSearch').attr('Value', 'Refresh');
			$('#loader').html("");
			
		});
	}
	
	
	if(option === "Ongoing"){
	
		if(option === "Ongoing"){
			$("#search_field").html("");
			$.ajax({
				method: "GET",
				url: "searchOngoing.php"
			}).done(function(data) {
				//return the data 
				$('#save_status').html(data);
				$('#error').html("");
				$('#btnSearch').attr('Value', 'Refresh');
				$('#loader').html("");
				
			});
		}
	}
	
	
	
	
}

/*

	
*/


function editBio(client, date) {

	// This lets you edit the admin notes (NEED ACCESS HANDLING()
	$.ajax({
	  method: "POST",
	  url: "patientEditBio.php",
	  data: {client: client,  date: date }
	}).done(function(data){
	  //$("#save_status").html("<div id='bioreadings'></div>");
	  
	  $('#bioreadings').html(data);
	});
}

function listBio() {

	//When in an individual reading, this displays all readings
	$.ajax({
	  method: "POST",
	  url: "patientListBio.php",
	  data: {
	  id: $('#ClientID').val(),
	  Date1: $('#Date1').val(),
	  Date2: $('#Date2').val()
	  }
	}).done(function(data){
	  $('#bioreadings').html(data);
	});
}

function editAdminNotes(id, datetime) {
	//this updates the individual notes admins can make on bioreadings
	
	var info = {
		"id": id,
		"datetime": datetime,
		"MedicationTaken": $('#MedicationsTaken').val(),
		"Other": $('#Other').val(),
		"InvolvedPersons": $('#InvolvedPersons').val(),
		"IfRedCall": $('#IfRedCall').val(),
		"Outcome": $('#Outcome').val()
	}
	
	var json = JSON.stringify(info);

	$.ajax({
	  method: "POST",
	  url: "patientEditAdminNotes.php",
	  data: {json: json  }
	}).done(function(data){
	  alert(data);
	  listBio();
	  
	
	});
	

	
	
}

/*
	Dropdown serach function
*/

function SearchBy() { 
	var option = $("#SearchBy").val();
	
	
	/* =====================
		Date
	 ===================== */
	if(option === "Date"){
		
		$("#search_field").html("OnDate: <input type='text' class='hasDatepicker' id='SelectDate' /><a href='#'  onclick='clearSearchFields()' >X</a>"+
		"<br/><input type='button' value ='<<<' onclick='subtractDay()' /><input type='button' value ='>>>' onclick='addDay()' />");
		
		resetDatepicker();
		/*//reset the datepicker
		$('#SelectDate').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			onClose: function() {
				search();
			}
		});*/
	}
	
	/* =====================
		PROVIDER
	 ===================== */
	if(option === "Provider"){
		//uses php to display a list of available providers
		var search = {
		  "function": "getProviders"
		 
		};
		
		var json = JSON.stringify(search);
		$.ajax({
		  method: "POST",
		  url: "searchProvider.php",
		  data: {json: json  }
		}).done(function(data){
		  $("#search_field").html(data);
		  $("#providers").focus();
		});
		
		
		
	}
	/* =====================
		PATIENT
	 ===================== */
	if(option === "Patient"){
		$("#search_field").html("First Name: <input type='text' id='FirstName' name='FirstName' id='FirstName'  /> "+
					"Last Name: <input type='text' id='LastName' name='LastName' id='LastName'  />"+ 
					"<br/><br/><input type='button' value='Display All' onclick='displayAllPatients()' />");
					
	$("#FirstName").focus();				
	$(document).ready(function(){
	    $('#FirstName').keypress(function(e){
	      if(e.keyCode==13) { $('#btnSearch').click(); }  
	    });
	    $('#LastName').keypress(function(e){
	      if(e.keyCode==13) { $('#btnSearch').click(); }  
	    });
	    
	});
	}
	
	/* =====================
		ONGOING
	 ===================== */
	 
	if(option === "Ongoing"){
		$("#search_field").html("");
		$.ajax({
			method: "GET",
			url: "searchOngoing.php"
		}).done(function(data) {
			//return the data 
			$('#save_status').html(data);
			$('#error').html("");
			$('#btnSearch').attr('Value', 'Refresh');
			
		});
	}
}

function displayAllPatients() {

  $('#FirstName').val("");
  $('#LastName').val("");
  search();
}



// Set the jquery datepicker when clicking on the SelectDate textbox
function resetDatepicker() {
	
	
	$("#SelectDate").removeClass('hasDatepicker').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd",
		onClose: function() {
			search();
		}
	});
 
	
	
	
	
	/* CODE TO GET datepicker to work with the browser*/
	
	var matched, browser;
	
	jQuery.uaMatch = function( ua ) {
	    ua = ua.toLowerCase();
	
	    var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
	        /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
	        /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
	        /(msie) ([\w.]+)/.exec( ua ) ||
	        ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
	        [];
	
	    return {
	        browser: match[ 1 ] || "",
	        version: match[ 2 ] || "0"
	    };
	};
	
	matched = jQuery.uaMatch( navigator.userAgent );
	browser = {};
	
	if ( matched.browser ) {
	    browser[ matched.browser ] = true;
	    browser.version = matched.version;
	}
	
	// Chrome is Webkit, but Webkit is also Safari.
	if ( browser.chrome ) {
	    browser.webkit = true;
	} else if ( browser.webkit ) {
	    browser.safari = true;
	}
	
	jQuery.browser = browser;
	
}

function clearSearchFields(){
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	
	if(dd<10) {
	    dd='0'+dd
	} 
	
	if(mm<10) {
	    mm='0'+mm
	} 
	
	today = yyyy + "-" + mm + "-" + dd;


	$("#SelectDate").val(today ) ;
	search();
}

function recallPatient(id) {

	var string = ""; 
	
	var c = confirm("Are you sure you want to recall this patient?\n\nAll values for today will be deleted.");
	if(c) {
		//Delete query so that todays calls are deleted
		$.ajax({
		  method: "POST",
		  url: "recall.php",
		  data: {ClientID: id}
		}).done(function(data){
			string += data + "<br>";
		  
		});
		
		//running listBio so the page refreshes
		//listBio();
		
		//call the testrkg.php with a parameter so that the call manually calls this client.
		
		$.ajax({
		  method: "POST",
		  url: "../testrkg.php",
		  data: {ClientID: id}
		  	
		});
		
		string += "The Teleaid is contacting the patient now.";
		alert(string);
	
	}
	
}

/* ==========================================
		CSV
   ========================================== */
   
function convertToCSV(sql) {
	// takes the sql string statements needed to run the command and posts it to the csv page.
	$.ajax({
	  method: "POST",
	  url: "convertToCSV.php",
	  data: {sql: sql}
	}).done(function(data){
	  $("#save_status").html(data);
	});
	
}

/* ==========================================
		Chart
   ========================================== */
   
function showChartView() {

	$("#bioreadings").html("");
	
	$.ajax({
	  method: "POST",
	  url: "chartView.php"
	}).done(function(data){
	  $("#patientToolbar").html(data);
	});
}

function showAdminView() {

	$("#bioreadings").html("");
	
	$.ajax({
	  method: "POST",
	  url: "adminView.php"
	}).done(function(data){
	  $("#patientToolbar").html(data);
	});
	
	//load dates
	
	
}
   
   

//ON LOAD FUNCTIONs

$(document).ready( function() {
	
	resetDatepicker();
	search();
	
	$('#ui-datepicker-div').hide();
	
	$(".hover").tooltip();
	
	
	
});
 
 
 
 
 
 
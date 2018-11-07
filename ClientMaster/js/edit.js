function editform(id, first, last) {
    loading();
    // Set the first and last name to the search boxes
    $('#FirstName').val(first);
    $('#LastName').val(last);
    
    

    //loading text
    $('#error').val("Loading...");


    // Using AJAX to POST DATA
    $.ajax({
        method: "POST",
        url: "http://www.thesaigroup.org/wp-admin/TeleSystem/ClientMaster/editForm.php",
        data: {id: id}
    }).done(function(data) {
        $('#save_status').html(data);
        $('#error').val("");
        stopLoading();

    });

}


function bioForm(id, first, last) {

	// Set the first and last name to the search boxes
	$('#FirstName').val(first);
	$('#LastName').val(last);
	
	//loading text
    	$('#error').val("Loading...");
    	
    	// Using AJAX to POST DATA
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/ClientMaster/biomarkers.php",
		data: {
		    id: id,
		    first: first,
		    last: last
		}
	}).done(function(data) {
		$('#save_status').html(data);
		$('#error').val("");

	}
	);

}




// Use the Json method for other methods, update all when have time.
function bioEdit() {
	
	
	//JSON a 2d array.
	//Decode on PHP and call variables like $json[BPSys][check]	
	var bio = { 
	
		
	
		"BPSys": {
			"check": $('#BPSysCheck').prop("checked"),
			"normal": $('#BPSysNormal').val(),
			"high": $('#BPSysHigh').val(),
			"low": $('#BPSysLow').val(),
			"notes": $('#BPSysNotes').text()
		
		},

		"BPDia": {
		
			"check": $('#BPDiaCheck').prop("checked"),
			"normal": $('#BPDiaNormal').val(),
			"high": $('#BPDiaHigh').val(),
			"low": $('#BPDiaLow').val(),
			"notes": $('#BPDiaNotes').text()
		},
		
		"Weight": {
		
			"check": $('#WeightCheck').prop("checked"),
			"normal": $('#WeightNormal').val(),
			"high": $('#WeightHigh').val(),
			"low": $('#WeightLow').val(),
			"notes": $('.WeightNotes').text()
		},
		
		"PulseRate": {
		
			"check": $('#PulseRateCheck').prop("checked"),
			"normal": $('#PulseRateNormal').val(),
			"high": $('#PulseRateHigh').val(),
			"low": $('#PulseRateLow').val(),
			"notes": $('#PulseRateNotes').text()
		}, 
		
		"OxygenSaturation": {
		
			"check": $('#OxygenSaturationCheck').prop("checked"),
			"normal": $('#OxygenSaturationNormal').val(),
			"high": $('#OxygenSaturationHigh').val(),
			"low": $('#OxygenSaturationLow').val(),
			"notes": $('#OxygenSaturationNotes').text()
			
		}, 
		
		"BloodSugar": { 
		
			"check": $('#BloodSugarCheck').prop("checked"),
			"normal": $('#BloodSugarNormal').val(),
			"high": $('#BloodSugarHigh').val(),
			"low": $('#BloodSugarLow').val(),
			"notes": $('#BloodSugarNotes').text() 
		},
		
		"Temperature": {
		
			"check": $('#TemperatureCheck').prop("checked"),
			"normal": $('#TemperatureNormal').val(),
			"high": $('#TemperatureHigh').val(),
			"low": $('#TemperatureLow').val(),
			"notes": $('.TemperatureNotes').text() 
		},
		
		"PeakFlow": {
		
			"check": $('#PeakFlowCheck').prop("checked"),
			"normal": $('#PeakFlowNormal').val(),
			"high": $('#PeakFlowHigh').val(),
			"low": $('#PeakFlowLow').val(),
			"notes": $('#PeakFlowNotes').text()
		},
		
		"C1": {
		
			"check": $('#C1Check').prop("checked"),
			"normal": $('#C1Normal').val(),
			"high": $('#C1High').val(),
			"low": $('#C1Low').val(),
			"notes": $('#C1Notes').val()
		},
		
		"C2": {
		
			"check": $('#C2Check').prop("checked"),
			"normal": $('#C2Normal').val(),
			"high": $('#C2High').val(),
			"low": $('#C2Low').val(),
			"notes": $('#C2Notes').val()
		},
		
		"id": $('#ClientID').val()
	
	}	
	
	var json = JSON.stringify(bio);
	
	//loading text
	//$('#error').text("Loading...");

	
	
	$.ajax({
		method: "POST",
		url: "http://www.thesaigroup.org/wp-admin/TeleSystem/ClientMaster/bioEdit.php",
		data: { json: json }
	}).done(function(data) {
		//return the data 
		$('#save_status').html(data);
		$('#error').html("");

	});
	
	

	
	
	
}





function editClient() {
	
	var phonecall = ""; 
	
	phonecall += $('#Mon').is(':checked') ? $('#Mon').val() + " " : ''; 
	phonecall += $('#Tue').is(':checked') ? $('#Tue').val() + " " : ''; 
	phonecall += $('#Wed').is(':checked') ? $('#Wed').val() + " " : ''; 
	phonecall += $('#Thu').is(':checked') ? $('#Thu').val() + " " : ''; 
	phonecall += $('#Fri').is(':checked') ? $('#Fri').val() + " " : ''; 
	phonecall += $('#Sat').is(':checked') ? $('#Sat').val() + " " : ''; 
	phonecall += $('#Sun').is(':checked') ? $('#Sun').val() + " " : ''; 
	
	phonecall = phonecall.trim();
	

	
	
	
	$('#error').text('');
	
	var client = {
	
		//get data
		"id": $('#ClientID').val(),
		
		
		"first": $('#FirstName').val(),
		
		"last": $('#LastName').val(),
		
	
		"middle": $('#MiddleName').val(),
		
		"address1": $('#Address1').val(),
		"address2": $('#Address2').val(),
		"address3": $('#Address3').val(),
		"address4": $('#Address4').val(),
		
		"city": $('#City ').val(),
		"state": $('#State').val(),
		"zip": $('#Zip').val(),
		"county": $('#County').val(),
		"country": $('#Country').val(),
		
		"phone": $('#Phone').val(),
		"fax": $('#Fax').val(),
		"email": $('#Email').val(),
		
		"dob": $('#DOB').val(),
		"dateProgInit": $('#DateProgInit').val(),
		
		
		"gender":  $("input:radio[name ='Gender']:checked").val(),
		
		"provider1": $('#Provider1').val(),
		"provider2": $('#Provider2').val(),
		"caregiver1": $('#Caregiver1').val(),
		"caregiver2": $('#Caregiver2').val(),
		
		"diagnosis1": $('#Diagnosis1').val(),
		"diagnosis2": $('#Diagnosis2').val(),
		"diagnosis3": $('#Diagnosis3').val(),
		"diagnosis4": $('#Diagnosis4').val(),
		
		"startDate": $('#startDate').val(),
		"endDate": $('#endDate').val(), 
		"phoneCallFrequency":  phonecall,
		"timeToCall": $('#timeToCall').val(),
		"timezone": $('#timezone').val(), 
		
		"StaffID": $('#StaffID').val(),
		
		"clientSchedule": $("input:radio[name ='clientSchedule']:checked").val(),
		"staffSchedule": $("input:radio[name ='staffSchedule']:checked").val(),
		"care1Schedule": $("input:radio[name ='Care1Schedule']:checked").val(),
		"care2Schedule": $("input:radio[name ='Care2Schedule']:checked").val(),
		"provider1Schedule": $("input:radio[name ='provider1Schedule']:checked").val(),
		"provider2Schedule": $("input:radio[name ='provider2Schedule']:checked").val()
	}

	//loading text
	$('#error').text("Loading...");
	
	var json = JSON.stringify(client);
	
	
	
	$.ajax({
	method: "POST",
	url: "http://www.thesaigroup.org/wp-admin/TeleSystem/ClientMaster/edit.php",
	data: { json: json }
	}).done(function(data) {
	//return the data 
	$('#save_status').html(data);
	$('#error').html("");
	
	});
	
	
	
}

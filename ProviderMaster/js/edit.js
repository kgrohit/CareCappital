function editform(ProviderID, first, last){

	first = first.trim();
	last = last.trim();

	$('#FirstName').val(first);
	$('#LastName').val(last);
	
	
        //loading text
	$('#save_status').text("Loading...");
        
        $.post('http://www.thesaigroup.org/wp-admin/TeleSystem/ProviderMaster/editForm.php', 
        	{id: ProviderID}, 
        	function(data) {
        		console.log(ProviderID);
		
			if(data != '' ){
				$('#save_status').html(data);
			} else {
				document.getElementById('save_status').innerHTML = "Provider could not be found.";
			}
	});
	
}



function editProvider(){

	
	
	var id = $('#ProviderID').val();
	
	if($('#FirstName').val() != ''){
		var first = $('#FirstName').val().trim();
	}
	if($('#LastName').val() != ''){
		var last = $('#LastName').val().trim();
	}
	
	var middle= $('#MiddleName').val();
	
	var disc= $('#DisciplineID').val();
	
	var add1= $('#Address1').val();
	var add2= $('#Address2').val();
	var add3= $('#Address3').val();
	var add4= $('#Address4').val();
	
	var city= $('#City').val();
	var state= $('#State').val();
	var zip= $('#Zip').val();
	var county= $('#County').val();
	var country= $('#Country').val();
	
	var phone= $('#Phone').val();
	var fax= $('#Fax').val();
	var email= $('#Email').val();
	
	var com1 = $('#CommMethod1').is(':checked');
   	var com2 = $('#CommMethod2').is(':checked');
	
	
        $.post('http://www.thesaigroup.org/wp-admin/TeleSystem/ProviderMaster/edit.php', 
	        {	id: id,
	        	first: first,
	        	middle: middle,
	        	last: last,
	        	disc: disc,
	        	add1: add1,
	        	add2: add2,
	        	add3: add3,
	        	add4: add4,
	        	city: city,
	        	state: state,
	        	zip: zip,
	        	county: county,
	        	country: country,
	        	phone: phone,
	        	fax: fax,
	        	email: email,
	        	com1: com1,
	        	com2: com2},
        	
        function(data) {
      
		$('#save_status').html(data);
			
	});


}
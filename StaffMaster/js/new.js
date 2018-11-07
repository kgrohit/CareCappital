function People() {
	var first = $('#FirstName').val(),
	var middle = $('#MiddleName').val(),
	var last = $('#LastName').val(),

	var disc = $("#DisciplineID").val(),
	
	
	var add1 = $('#Address1').val(),
	var add2 = $('#Address2').val(),
	var add3 = $("#Address3").val(),
	var add4 = $("#Address4").val(),
	
	var city = $("#City").val(),
	var state = $("#State").val(),
	var zip = $("#Zip").val(),
	var county = $("#County").val(),
	var country = $("#Country").val(),
	
	var phone = $("#Phone").val(),
	var fax = $("#Fax").val(),
	var email = $("#Email").val(),
	
	var com1 = $("#CommMethod1").is(":checked"),
	var com2 = $("#CommMethod2").is(":checked")
}

function staff() {
	People.call(this);
	
	alert(this.first);
}

staff.prototype = new People();
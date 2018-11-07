function validatePassword() {
	
	updateUser();
	//pw validate 
	//check match, length, upper, lower, numbers
	
	var re; // regex variable
	var pw1 = $("#password1").val();
	var pw2 = $("#password2").val();
	
	//match
	if( pw1 != pw2){
		$('#password1').prop("title", "Passwords must match.");
		return false;
	}
	
	//length
	if(pw1.length < 8 ) {

		$('#password1').prop("title", "Passwords must have at least 8 characters.");
		return false;
	}
	
	//upper
	re = /[A-Z]/;
	if(!re.test(pw1)) {

		$('#password1').prop("title", "Passwords must have an upper case character.");
		return false;
	}
	
	//lower
	re = /[a-z]/;
	if(!re.test(pw1)) {
		$('#password1').prop("title", "Password must contain a lowercase character.");
		return false;
	}
	
	//number
	re = /[0-9]/;
	if(!re.test(pw1)) {
		$('#password1').prop("title", "Password must contain a number.");
		return false;
	}
	$('#password1').prop("title", "Acceptable Password.");
	$("#password1").tooltip( "open" );
	return true;
}

function updateUser() {

	//var array = JSON.stringify($('#account_form').serializeArray());
	
	var o = {};
	var a = $('#account_form').serializeArray();
	
	$.each(a, function() {
		if (o[this.name] !== undefined) {
		    if (!o[this.name].push) {
		        o[this.name] = [o[this.name]];
		    }
		    o[this.name].push(this.value || '');
		} else {
		    o[this.name] = this.value || '';
		}
	});
	
	o = JSON.stringify(o);
	
	
	$.ajax({
		method: "POST",
		url: "account.php",
		data: { function: "updateUser", json: o}
	}).done(function( data) {
		alert(data);
	});
	
	
}

$( document ).ready(function() {

	$('#password1').prop("title", "8 character minimum. \n1 UpperCase \n1 Lowercase \n1 Number");
	

});


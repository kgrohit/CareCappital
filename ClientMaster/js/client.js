$(document).ready( function() {

	//enabling date pickers
	$('#DOB').datepicker({
		changeYear: true, 
		yearRange: "1900yy: yy+1",
		changeMonth: true
	});
	
	$('#endDate').datepicker({
		changeMonth: true,
		changeYear: true
	});
	
	$('#startDate').datepicker({
		changeMonth: true,
		changeYear: true
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
	
	// end code
	
	
	$('#kgCheck').on('change', function() {
		$('.weight').text("kg");
	});


});

function setCallFreq(id) {

	if(id === 'Daily' ) {
		$('#Mon').prop('checked', true);
		$('#Tue').prop('checked', true);
		$('#Wed').prop('checked', true);
		$('#Thu').prop('checked', true);
		$('#Fri').prop('checked', true);
		$('#Sat').prop('checked', true);
		$('#Sun').prop('checked', true);
	} 
	
	if(id === 'MWF' ) {
		$('#Mon').prop('checked', true);
		$('#Tue').prop('checked', false);
		$('#Wed').prop('checked', true);
		$('#Thu').prop('checked', false);
		$('#Fri').prop('checked', true);
		$('#Sat').prop('checked', false);
		$('#Sun').prop('checked', false);
	} 
	
	if(id === 'M' ) {
		$('#Mon').prop('checked', true);
		$('#Tue').prop('checked', false);
		$('#Wed').prop('checked', false);
		$('#Thu').prop('checked', false);
		$('#Fri').prop('checked', false);
		$('#Sat').prop('checked', false);
		$('#Sun').prop('checked', false);
	} 
	
	if(id === 'Stop' ) {
		$('#Mon').prop('checked', false);
		$('#Tue').prop('checked', false);
		$('#Wed').prop('checked', false);
		$('#Thu').prop('checked', false);
		$('#Fri').prop('checked', false);
		$('#Sat').prop('checked', false);
		$('#Sun').prop('checked', false);
	} 
}






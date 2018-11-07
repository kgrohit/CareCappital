<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js'></script>
<script type='text/javascript' src="chart.js"></script>

<div style='text-align: left; ' >
	
	<h3 style='text-align: left;' >Chart Options</h3>
	
	<!-- Datepickers -->
	<input type='text'  id='Date1' value=""  /> - TO - 
	<input type='text'  id='Date2'  value=""  />
	
	<select id='bio-select' required >
		<option value='' >Select Biomarker...</option>
		<option value='1' >Systolic</option>
		<option value='2' >Diastolic</option>
		<option value='3' >Weight</option>
		<option value='4' >Pulse</option>
		<option value='5' >Oxygen Saturation</option>
		<option value='6' >Glucose</option>
		<option value='7' >Temperature</option>
		<option value='8' >Peak Flow</option>
		<option value='9' >Custom Question 1</option>
		<option value='10' >Custom Question 2</option>
	</select>
	
	<input class='btn btn-default' id='btn-chart' type='button' value='Create Chart' />
	<input class='btn btn-danger' id='btn-clear' type='button' value='Clear' />
	</div>
	
	<div id='chart-container'><canvas id="myChart" ></canvas></div>
	
</div>

<script>

	//post load script
	//Handles filling in text and Datepickers
	
	
	
	if($('#Date1').val() == '' ) {
	    $('#Date1').val( $('#Date1Default').val() ) ;
	}
	
	if($('#Date2').val() == '' ) {
	    $('#Date2').val( $('#Date2Default').val() );
	}
	
	
	
	
	//DatePickers
	$('#Date1').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd",
		onClose: function() {
			//listBio();
		}
	});
	$('#Date2').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd",
		onClose: function() {
			//listBio();
		}
	});


</script>
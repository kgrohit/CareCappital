<div style='text-align: left;'>
<br>
	<!-- Datepickers -->
	<input type='text'  id='Date1' value="" onchange="handlePatientDates()" /> - TO - 
	<input type='text'  id='Date2'  value="" onchange="handlePatientDates()" />
	<a id='excel-link'>Export to Excel</a>	
	<script>
	  var $link;
	  var $id=$('#clientid').val();
	  $link = "convertToCSV.php?clientid="+$id;
	  $link = $link + "&date1="+$('#Date1Default').val();
	  $link = $link + "&date2="+$('#Date2Default').val();
	  document.getElementById('excel-link').setAttribute('href',$link);
	 </script>

</div>


<script>
	$('#Date1').val( $('#Date1Default').val() );
	$('#Date2').val( $('#Date2Default').val() );
	listBio();
	var id = $('#clientid').val();
	var date1=$('#Date1').val();
	var date2=$('#Date2').val();
	
	
	function handlePatientDates() {
		console.log('Date1: '+ $('#Date1Default').val());
		console.log('Date2: '+ $('#Date2Default').val());

		// IF either Date1 or Date2 are null, set them to the defaults.
		if($('#Date1').val() === '' ) {
		    $('#Date1').val() = $('#Date1Default').val();
		}
		
		if($('#Date2').val() === '' ) {
		    $('#Date2').val() = $('#Date2Default').val();
		}
		
		
		//get the data
		var id = $('#clientid').val();
		var date1 = $('#Date1').val();
		var date2 = $('#Date2').val();
		
		var link = "convertToCSV.php?clientid=" + id + "&date1=" + date1 + "&date2=" + date2;
		
		//change the link
		$('#excel-link').attr("href", link );
		
		//Run the listBio function
		listBio();
	}
	
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
	
	$(document).load(function() {
	  
	});
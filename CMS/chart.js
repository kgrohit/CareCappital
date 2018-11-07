var Module = (function () {
	
	//cache dom
	
	//buttons
	var $btn = $('#btn-chart');
	var $clear = $('#btn-clear');
	
	//textboxes
	var $bio = $("#bio-select");
	var $clientid = $('#ClientID');
	var $date1 = $('#Date1');
	var $date2 = $('#Date2');
	
	$bioreadings = $('#bioreadings');
	
	var $chart = document.getElementById('myChart');
	var ctx = $chart.getContext("2d");
	var myLineChart;
	
	
	
	 
	//events
	$btn.on('click', function(e) {
		
		//if(validInfo()) {
		getChart();
		//}
	 	
	 });
	 
	$clear.on('click', function(e) {
		//ctx = $chart.getContext('2d');
		//ctx.clearRect(0,0, $chart.width, $chart.height);
		$chart.destroy();	
	});
	
	
	
	
	
	
	function init() {  
			
		
	}
	 
	 
	
	function getChart() {
	
		
		//initializing the data object
		var data = ""; 
		
	
		// Getting the data from the chart.php file
		//returns a json array with the DateTimeOfCall and Value1
		data = $.parseJSON($.ajax({
			url:  'chartData.php',
			dataType: "json", 
			async: false,
			data: {
				bio: $bio.val(),
				date1: $date1.val(),
				date2: $date2.val(),
				clientid: $clientid.val()
			}
		     }).responseText);
		     
			     
		     
		
		//create arrays with each value
		var labels = [], // ['2016-11-30','2016-11-30','2016-11-30','2016-11-30'] 
		    values = []; // [46,92,127,99999,83]
		
		//save the labels and values to be used in the data object
		for(var i = 0; i < data.length; i++ ){
			if(data[i]['DateTimeOfCall']) { // ignores all arrays returned that dont include datetimeofcall
				labels.push(data[i]['DateTimeOfCall']);
				values.push(data[i]['Value1']);
			}
		} 
		
		
		
		//data object used to create the chart. Most of this is prestock stuff from the api site
		var data = {
			labels: labels,//using the values from the json request ie "DateTimeOfCall"
			datasets: [{
			    label: data[0]['title'],
			    fill: false,
			    lineTension: 0.1,
			    backgroundColor: "rgba(75,192,192,0.4)",
			    borderColor: "rgba(75,192,192,1)",
			    borderCapStyle: 'butt',
			    borderDash: [],
			    borderDashOffset: 0.0,
			    borderJoinStyle: 'miter',
			    pointBorderColor: "rgba(75,192,192,1)",
			    pointBackgroundColor: "#fff",
			    pointBorderWidth: 1,
			    pointHoverRadius: 5,
			    pointHoverBackgroundColor: "rgba(75,192,192,1)",
			    pointHoverBorderColor: "rgba(220,220,220,1)",
			    pointHoverBorderWidth: 2,
			    pointRadius: 1,
			    pointHitRadius: 10,
			    data: values, //using the values from the json request ie "Value1"
			}]
		};
		
		
		// FINALLY
		// Chart construction, using the data object with additional options.
		myLineChart = new Chart( $chart , {
		type: 'line',
		data: data,
		options: {
			responsive: 'true',
			responsiveAnimationDuration: "5000",
			title: { display: true },
			bezierCurve: false
		}
		});
	}
	
	
	
	  
	
	
	
	init();
})();

  
  
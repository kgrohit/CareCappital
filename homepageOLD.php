<!doctype html>
<html>
<head>	
	<link rel="stylesheet" href="http://www.thesaigroup.org/wp-admin/TeleSystem/main.css" />
	<title>TeleSystem</title>
	 <link rel="shortcut icon" href="favicon.ico" />
	 
	 <style>
	   #wrapper {
 	     background: url(images/care-cappital-building.png);
 	     background-repeat: no-repeat;
 	     background-attachment: fixed;
 	     background-size:1920px 90%;
 	     background-position: center 100%;
	     //-webkit-background-size: cover;
	     //-moz-background-size: cover;
	     //-o-background-size: cover;
	     //background-size: cover;
 	    
 	   }
 	   
 	   #login { 
 	     float: right;
 	     margin-top: 25%;
 	   }
 	   
 	   #content {
 	     width: 60%;
 	     color: black;
 	   }
 	   
 	   #content input[type='button'], #content button {
 	   	margin-right: 25px;
 	   	float: right;
 	   	color: black;
 	   }
 	   
 	   #content input[type='password'] { 
 	     margin-right: -15px;
 	   }
	 </style>
</head>
<!-- 		HOME PAGE		 -->
<body>
	
		
		
		<div id='wrapper'>
		
		
			
		
			<?php include 'defaultHeader.php'; ?>
			
			<div id='content' >

				
				
				<div id='login' > 
					User Name: <input type='text' /><br/>
					Password: <input type='password' /><br/>
					<input type='button' value='Log in' onclick='' />
				</div>
			</div> <!-- content -->
		</div> <!-- wrapper -->
		
		<?php include 'http://www.thesaigroup.org/wp-admin/TeleSystem/footer.php' ?>
</body>
</html>
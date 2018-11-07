<!DOCTYPE HTML>
<html>
<head>
	<title>Password Reset</title>
	<link rel="stylesheet" href="https://www.thesaigroup.org/wp-admin/TeleSystem/main.css" />
	<script type='text/javascript' src='password.js'></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
	<div id='wrapper'>
		<div id='content'>
			<?php include '../headerNew.php'; ?>
			<br/><br/>
			
			
			<br/>			
			<div id='save_status'>
				
			<form method="POST" action="password.php">
					<h1>Password Reset</h1>
					
					Enter your email.<br/>
					
					<input id='Email' name='Email' type='text'  style='width: 250px; text-align: center; '/>
					
					<br/><br/>
					
					<input type='submit' value='Submit'  />
					
					<br/><br/>
					
					<div id='error'><br/></div>
			</form>
					
			</div>
		</div> <!-- Content -->
	</div> <!-- wrapper-->
	<?php include '../footer.php'; ?>

</body>
</html>
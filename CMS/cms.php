<?php
	// grab db
	include '../init.php';
	
	
	// check if a session is active
	if(empty($_SESSION['user']) && empty($_SESSION['client']) ){
		//ERROR Session not found. Redirect to homepage
		header("Location: index.php");
	}
	
	
	
	//check to see if the logout has expired
	if( $_SERVER['REQUEST_TIME'] > $_SESSION['user']['timeout']) {
		header("Location: ../Account/logout.php");
	}else {
	
		//if the user is still active, give them 30 additional minutes
		$_SESSION['user']['timeout'] = $_SERVER['REQUEST_TIME'] + 1800;
	}
	

	if($_SESSION['user'] && $_SESSION['user']['pwExpire'] < $_SERVER['REQUEST_TIME']  ) {
		header("Location: ../Account/accountForm.php");
	} 

	/*
	echo "TYPE: ";
	print_r( $_SESSION['user']);
	
	echo "<br/>CLIENT: ";
	print_r($_SESSION['client']);
	*/
	
	
	
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://www.thesaigroup.org/wp-admin/TeleSystem/main.css" />
	<title>CMS</title>
	<meta charset="utf-8"/>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
	//<script type='text/javascript' src="cms.js"></script>
	
	<style>
	
	#content, #wrapper {
		width: 100%;
		margin: 0;
		padding: 0;
	}
	
	#save_status, #thehead { 
		width: 99%;
		margin: 0 auto;
		padding: 0;
	}
	
	#thehead { 
		padding: 10px;
		width: 98%;
	}
	
	
	</style>
	
	
</head>
<body onload="">
<div id='wrapper'>
	
	<?php if($_SESSION['user']):?>
		<p style=" text-align: right; margin-right: 20%; background-color: #fff;">
			<?php	echo "Hello ". $_SESSION['user']{'UserName'} . "."; ?>
			
			<a href="https://www.thesaigroup.org/wp-admin/TeleSystem/Account/logout.php">
				Logout
			</a>
		</p>
	<?php 
		endif;
		if($_SESSION['user']) {include '../header.php'; } 
	?>

	<br/>
	<div id='content'>
		
		<br/>
			<h1>Central Monitoring Station</h1>
			
			<div id='thehead' >
				
				<br/>
				
				
				<input type='button' id='btnSearch' value='Refresh' onClick='search()' onTap='search()' class='menu'  />
				<select name="SearchBy" id="SearchBy" onchange="SearchBy()" >
					<option value="">Search By...</option>
					
					<option value="Date" selected='' >Date</option>
					
					<option value="Patient" >Patient</option>
					
					<?php if($_SESSION['user']['AccountType'] == 'staff'): ?> <option value="Provider" >Provider</option> <?php endif; ?>
					
					<?php if($_SESSION['user']['AccountType'] == 'staff'): ?> <option value="Ongoing" >Ongoing</option> <?php endif; ?>
					
					

				</select>
				<div id='loader' ></div>
				
				<br/><br/>
				<div id='search_field'>
					OnDate: <input type='text' id='SelectDate' value="<?php echo date('Y-m-d'); ?>"/>
					<a href="#" onclick="clearSearchFields()" >X</a> <br/>
					<input type='button' value ="<<<" onclick="subtractDay()" />
					<input type='button' value =">>>" onclick="addDay()" />
				</div>
				
				
				<?php
					//echo mktime($_SESSION['user']['timeout']);
					
				?>
	
				
				<span id='error'><br/></span>
			</div> <!-- theheader-->
				
				
			<div id='save_status'></div>
	</div><!-- Content -->
</div><!-- Wrapper -->

<script type='text/javascript' src="cms.js"></script>


<?php include '../footer.php'; ?>


</body>
</html>
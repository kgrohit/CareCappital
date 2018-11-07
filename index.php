<?php
    include "init.php";
    
    // this is the code to check if a user isnt logged on.
     if(empty($_SESSION['user'])){
     	include 'homepage.php';   //displays log in form.
        
     	
    }else if ($_SESSION['user']['UserName'] != 'ccrosby' && $_SESSION['user']['UserName'] != 'rgupta' ){ 
    	header("Location: CMS/cms.php");
    	
     }else { // if user is logged
     
     /* ============================================================
     
     	ONLY COTY AND ROHIT CAN SEE BELOW 
     	TESTING PURPOSES
     
     
     	...specifically users ccrosby and rgupta
     
        ============================================================  */
     		?>
	<head>	
		<link rel="stylesheet" href="https://www.thesaigroup.org/wp-admin/TeleSystem/main.css" />
		<title>TeleSystem</title>
		 <link rel="shortcut icon" href="favicon.ico" />
	</head>
<!-- 		HOME PAGE		 -->

	
		
		
		<div id='wrapper'>
		
			<p style=" text-align: right;
  				margin-right: 20%;
 				background-color: #fff;">
 					<?php
				echo "Hello ". $_SESSION['user']{'UserName'} . ".";
			?>
			<a href="https://www.thesaigroup.org/wp-admin/TeleSystem/Account/logout.php">Logout</a>
			</p> 
			<?php 
				include 'https://www.thesaigroup.org/wp-admin/TeleSystem/header.php';
				//print_r($_SESSION['user']);
			?>
			<div id='content'>
				<br/><br/><br/><br/>
				<div id='save_status'>
					
					
					<h1>Testing info</h1>
					<br>
					<?php
					
						echo "<a href='Test/index.php' >Test Page</a><br><br><br>";
						
						echo "<a href='NewTheme/index.php' >New Theme</a><br><br><br>";
						
						print_r($_SESSION['user']);
						
						echo "<br>Password Expires: ";
						echo date("Y/m/d H:i:s a", $_SESSION['user']['pwExpire']);
						
						echo "<br><br>Current Time: ";
						echo date("Y/m/d H:i:s a", $_SERVER['REQUEST_TIME']);
						
						echo "<br><br>Timeout: ";
						echo date("Y/m/d H:i:s a", $_SESSION['user']['timeout']);
						echo "<br>";
						
						echo date('Y-m-d H:i:s') . " - $_SERVER[REMOTE_ADDR]";
						
						echo "<br><br>";
						
						


						
						

						

						
						
						
					?>
						
				</div> <!-- savestatus -->	
			</div> <!-- content -->
		</div> <!-- wrapper -->
		

	<?php
	}// if user is logged on
$connection = null;
 ?>
<?php 

    require("../init.php");
    session_start();
    
    // At the top of the page we check to see whether the user is logged in or not
    if(empty($_SESSION['user']))
    {

        header("Location: http://www.thesaigroup.org/wp-admin/TeleSystem/index.php");
        
    }
    
    //check to see if the logout has expire
    if( $_SERVER['REQUEST_TIME'] > $_SESSION['user']['timeout']) {
        header("Location: ../Account/logout.php");
    }
	
    $_SESSION['user']['timeout'] = $_SERVER['REQUEST_TIME'] + 1800;
    
    //same if they lack admin access aka EDIT Role
    if ($_SESSION['user']['Role'] != 'admin1' && $_SESSION['user']['Role'] != 'admin2' ){ 
    	header("Location: ../CMS/cms.php");
    	
     }
    
    // Everything below this point in the file is secured by the login system
    
    // We can display the user's username to them by reading it from the session array.  Remember that because
    // a username is user submitted content we must use htmlentities on it before displaying it to the user.

?>
<!DOCTYPE html SYSTEM "about:legacy-compat">
<html>
<head>
<meta charset="utf-8" >
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/js/add.js" ></script>
<script type="text/javascript" src="http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/js/edit.js" ></script>
<script type="text/javascript" src="http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/js/search.js" ></script>
<script type="text/javascript" src="http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/js/delete.js" ></script>
<link rel="stylesheet" href="http://www.thesaigroup.org/wp-admin/TeleSystem/main.css" />

<title>Medical Diagnosis</title>

</head>


<!-- onload gives focus to the firstname textfield -->
<body onload='search()'>
<div id='wrapper'>
	
	<p 	style=" text-align: right;
  		margin-right: 20%;
 		background-color: #fff;">
	 	<?php
			echo "Hello ". $_SESSION['user']{'UserName'} . ".";
		?>
		<a 
			href="http://www.thesaigroup.org/wp-admin/TeleSystem/Account/logout.php">Logout</a>
	</p> 
	<?php include '../header.php'; ?> <!-- grab the header -->
	
	<div id='content' >
		
		<h1 >Medical Diagnosis</h1>
		
		<div id='thehead' >
			<div id='toolbar'>
				<input type='button' id='btnAdd' value='Add' onClick='addForm()' class='menu'  />		
			</div>
			<br/>
	
			<span id='error'><br/></span>
			
		</div> <!-- thehead-->
		<div name='save_status' id='save_status' >
		
		</div>
		<br/><br/>
		
	</div> <!-- content -->
</div> <!-- wrapper -->


<?php include '../footer.php'; ?><!-- grab the footer -->
</body>
</html>
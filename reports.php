<?php

    // First we execute our common code to connection to the database and start the session
    require("init.php");
    
    // At the top of the page we check to see whether the user is logged in or not
    if(empty($_SESSION['user']))
    {
        // If they are not, we redirect them to the login page.
        header("Location: index.php");
    }
    
    // Everything below this point in the file is secured by the login system
    
    // We can display the user's username to them by reading it from the session array.  Remember that because
    // a username is user submitted content we must use htmlentities on it before displaying it to the user.
?>
<!DOCTYPE html>
<html>
<head>
	<title>Caretronic TeleSystem</title>
	<link rel="stylesheet" href="http://www.thesaigroup.org/wp-admin/TeleSystem/main.css" />

</head>
<body>

<div id='wrapper'>

	<a href="http://www.thesaigroup.org/wp-admin/TeleSystem/Login/logout.php"
	style=" text-align: right; margin-left: 77%;background-color: #fff;"
	>Logout</a> <br/>
	<?php include 'http://www.thesaigroup.org/wp-admin/TeleSystem/header.php' ?>
	<div id='content'>
	
	<h1>Reports</h1>
	<br/><br/>
	
		
	<img src="images/bargraph.png" />
	<img src="images/linechart.jpg" />
	<img src="images/piechart.jpg" />


	
	</div> <!-- content -->
</div> <!-- wrapper -->

<?php include 'http://www.thesaigroup.org/wp-admin/TeleSystem/footer.php' ?>

</body>
</html>
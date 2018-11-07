<?php
    // Grab DB ( init.php has been upgraded to start a session. ) Inside the if statement so the session doesn't start on the first load.
    require("../init.php");

    
    // if we set up a log in from another site, this will allow them to bypass the homepage and log straight in ( with credentials )
    if(!empty($_POST))
    {
    
    	//save variables
    	$username = $_POST['username'];
    	$password = $_POST['password'];
    	
    	
        // This query retreives the user's information from the database using
        // their username.
      /*  $sql = "SELECT UserMaster.AccountID, UserMaster.TypeID, UserMaster.AccountType, UserMaster.UserName, UserMaster.salt, UserMaster.pw1,
	     UserMaster.pwExpire, UserSecurity.Role
	     FROM UserMaster
	     INNER JOIN UserSecurity
	     WHERE UserMaster.UserName = '$username'
	     AND UserMaster.AccountID = UserSecurity.AccountID";
	     
	  $row = $connection->query($sql)->fetch();*/
	  
	  $sql = "SELECT UserMaster.AccountID, UserMaster.TypeID, UserMaster.AccountType, UserMaster.UserName, UserMaster.salt, UserMaster.pw1,
	          UserMaster.pwExpire, UserSecurity.Role
	          FROM UserMaster
	          INNER JOIN UserSecurity
	          WHERE UserMaster.UserName = :username
	          AND UserMaster.AccountID = UserSecurity.AccountID";
	          
	  $stmt = $connection->prepare($sql);
	  
	  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
	  if($stmt->execute() ) {
	  	$row = $stmt->fetch();
	  }
	          
	  
        // This sets up a log in boolean. 
        $login_ok = false;
        
        // Retrieve the user data from the database.  If $row is false, then the username
        // they entered is not registered.
        if($row)
        {
                    
            // Using the password submitted by the user and the salt stored in the database,
            // we now check to see whether the passwords match by hashing the submitted password
            // and comparing it to the hashed version already stored in the database.
            $check_password = hash('sha256', $_POST['password']. $row['salt']);
            
            for($round = 0; $round < 65536; $round++)
            {
                $check_password = hash('sha256', $check_password . $row['salt']);
            }
            
           // echo "Entered Password: ". $check_password. "<br/><br/>Account Password: ". $row['pw1']; 
            
            
            // if the pw match, set login ok to true
            if($check_password === $row['pw1'])
            {
                // If they do, then we flip this to true
                $login_ok = true;
            } else {
            	//echo "passwords do not match";
            }
            
                      
        } else {
        	//echo "User not found.<br/>";
        }
        
        // If the user logged in successfully, then we send them to the private members-only page
        // Otherwise, we display a login failed message and show the login form again
        if($login_ok)
        {
        
            //unset the log in attempts sesssion
            unset($_SESSION['login']);
            
            // row is what the users information is set to. We don't need it after this, so we remove the salt and password from the array
            unset($row['salt']);
            unset($row['pw1']);
            
            session_start();
            // the session is what we check on all of the other pages to make sure the user is logged on. 
            $_SESSION['user'] = $row;
            
            $_SESSION['user']['timeout'] = $_SERVER['REQUEST_TIME'] + 1800;
            
            
            
            
	    /* REMEMBER ME */
	    if($_POST['remember']) {
	      $year = 86400 * 365;
	      setcookie('remember_me', $_POST['username'], time() + $year, '/');
	    } elseif(!$_POST['remember']) {
	      if(isset($_COOKIE['remember_me'])) {
	        $past = time() - 100;
	        setcookie('remember_me', gone, $past, '/');
	      }
	    }
            
            
        
            /* pw expire */
           if( $row['pwExpire'] <= $_SERVER['REQUEST_TIME'] ) {
            		header("Location: ../Account/accountForm.php");
            } else {
	            
	            // This reloads the page. By default, the page shows the Login/login.php page, but when you're logged in, it displays the actual index.php file. 
	            header("Location: ../index.php");
           
	    }
            
            
            
        } else { // Didnt log in. Redirect back to home page and start a session.
        
           if(!empty($_SESSION['login'])){
           	$_SESSION['login']['Attempts']++;
           } else {
           	$_SESSION['login']['Attempts'] = 1;
           }
           
           // Redirect back to homepage
           header("Location: ../index.php");
          
   
        }
    }
    
    
/*
?>
<!DOCTYPE html>
<html>
<head>
	<title>Caretronic TeleSystem</title>
	<link rel="stylesheet" href="http://www.thesaigroup.org/wp-admin/TeleSystem/main.css" />

	<style>
	/*
		#content { text-align: center;}
		
		#content:a {  margin-left: 10px;  background-color: #eee;}
		
		input[type='text'], input[type='password'] {  width: 25%;}
		
		input[type='button']{  width: 15%;}
		
		label{  margin-right: 10px;}
		
		#boxxy {
		  background-color: #eee;
		  width: 50%;
		  text-align: center;
		  margin: 0 auto;
		  border-left: 1px solid #777777;
		  border-right: 1px solid #777777;
		  border-bottom: 1px solid #777777;
		  box-shadow: 5px 5px 1em #777777;
		}	
		*/ /*
	</style>

</head>
<body>

<div id='wrapper'>
	<?php include '../defaultHeader.php' ?>
	<div id='content'>
	
	<h1>Log-in</h1>
	<br/><br/>
	
	<div id='save_status'><br/><br/>
	<form action="#" method="POST">
		<label for=''>Username: </label>
		<input id='username' name="username" type='text' value="<?php echo $submitted_username; ?>"/>
		<br/>
		<label for=''> Password   :</label>
		<input id='password' name="password" type='password' />
		<br/><br/>
		<input id='btnLogin' type='submit' value='Submit' onclick='' />
		<br/><br/>
	</form>
	<a href='../Password/password.php' > Forgot your password? </a>
	</div>

</br>


	
	</div> <!-- content -->
</div> <!-- wrapper -->

<?php include 'http://www.thesaigroup.org/wp-admin/TeleSystem/footer.php' ?>

</body>
</html>

*/
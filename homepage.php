<!DOCTYPE html>
<html  lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Care Cappital</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/full.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<style>
/*
/* hide the navbar background */
.navbar  {
    background: rgba(255, 255, 255, 0.0);
    border-bottom: none;
}

/* Change the links to red */
.navbar .container .collapse ul li a {
    color: #cc0000;
}
.navbar .container .collapse ul li a:hover {
  color: #ff0000;
}

#footer {
    position: relative; 
    bottom: 0%;
}
@import url(https://fonts.googleapis.com/css?family=Oswald:400,300,700);
#logo{
    font-family: Impact, Charcoal, sans-serif;
    font-size: 4em;
    opacity: 1;
}
#logo:hover { 
  border: none; 
  text-decoration: none; 
  opacity: .9;
}

.navbar-header a {
  text-decoration: none;
}

.blue { 
  color: rgb(147, 152, 206 ); 
}

.red { 
  color: rgb(206,34,57);
}

/* The menu icon for mobile navigation */
.navbar .container .navbar-header .navbar-toggle{ border: 1px solid rgb(206,34,57); }
.navbar .container .navbar-header .navbar-toggle .icon-bar {
    background-color: rgb(206,34,57);
}




</style>
</head>

<body class='body' >
    
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-static-top" role="navigation"  style='border-bottom: 2px solid rgb(147, 152, 206 );'>
<div class="container" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <!--<a class="navbar-brand" href="#">CARE CAPPITAL<sup><small>TM</small></sup></a>-->
        <a href="#" class="pull-left">
        <H1 id='logo'>
            <span class='red'>care</span>
            <span class='blue'>c</span><span class='red'>app</span><span class='blue'>ital</span>
        </H1>
        </a>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav pull-right pull-down" >
            <li>
                <a href="#" 
                 <?php 
               		if($_COOKIE['remember_me']) { echo "onclick=\"$('#password').focus()\""; }
               		else { echo "onclick=\"$('#username').focus()\""; }
 		?>
 		 >LOGIN</a>
            </li>
            <li>
                <a href="#about">Manual</a>
            </li>
        </ul>

    </div><!-- /.navbar-collapse -->

</div><!-- /.container -->

</nav>

    

<div id='wrapper' class='container'>
	<div class='row'>
	
		<!-- LOG IN -->
		
		<div class='col-lg-6  ' >
		<h3>Log in</h3>
		
		<form class="form-horizontal well " method='post' action='https://www.thesaigroup.org/wp-admin/TeleSystem/Account/login.php'>
		<div class="form-group">
		<span class="col-sm-2 control-label">Username</span>
		<div class="col-sm-10">
		<input type="text" class="form-control"  placeholder="Username" name='username' id='username' value="<?php echo $_COOKIE['remember_me']; ?>">
		</div>
		</div>
		
		<div class="form-group">
		<span  class="col-sm-2 control-label">Password</span>
		<div class="col-sm-10">
		<input type="password" class="form-control" id="inputPassword3" placeholder="Password" name='password'>
		</div>
		</div>
		
		
		<div class="checkbox">

		<label for='remember' >
		<input type="checkbox" id='remember' name='remember' 
		<?php if($_COOKIE['remember_me']) { echo 'checked'; } ?> 
		> Remember Me 
		</label>
		</div>
		
		
		
		<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		<button type="submit" class="btn btn-primary" onclick="return getPermission()" >Sign in</button> 
		
		</div>
		
		
		</div>
		
		<a href='Password/'>Forgot your password?</a>
		<br/>
		<?php 
			//check to see how many times the computer has logged in.
			if($_SESSION['login']){
				echo "Attempts: ". $_SESSION['login']['Attempts'];
			} 
			
			echo $_COOKIE['remember']; 
		?>
		</form>
		
		
		
		<br><br><br><br><br>
		
		<p>A Product of: 
		<img class='img-responsive  '  src='https://www.thesaigroup.org/wp-admin/TeleSystem/images/caretronic.jpg'>
		</p>
		
		<p>
			<strong>Technical Support</strong><br/>
			P: (419) 472-5350<br/>
			F: (419) 472-8340<br/>
			E: support@caretronic.net
		</p>
		</div>
		
		<!-- IMAGE LOGO -->
		<div class='col-lg-6 '>
			<img class='img-responsive  '  src='images/care-cappital-newlogo.png'>
		</div>
	
	
	
	</div><!-- row -->
	    
	

        

</div> <!-- container -->
    

<br><br><br>

    <!-- FOOTER -->
    <footer class=''>
        <small>
        <div class='container'>

        <p style='float: left;'>
        <br/>
        &copy; 2016, The S.A.I. Group of Companies 
        </p>



        </div>
        </small>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Additional script-->
    <script>
        $('.pull-down').each(function() {
		$(this).css('margin-top', $(this).parent().height()-$(this).height());

	});
	
	function getPermission() {
	  var popup = confirm("Are you sure you wish to log in?\n(Update this message)");
	  return popup;
	}
    </script>

</body>

</html>
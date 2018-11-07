<?php
	
    // These variables define the connection information for your MySQL database
    /*
    $username = "saigroup";
    $password = "vH609pP9Uqou";
//  $password="M87INvkEHffG";
    $host = "localhost";
    $dbname = "saigroup_telesystem"; 
    */
    
    $username = "saigroup";
    $password = "vH609pP9Uqou";
//  $password="M87INvkEHffG";
    $host = "localhost";
    $dbname = "saigroup_telesystem"; 
    
    //set options
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    
    //set up connection to db. all db calls will use $connection var
    try
    {

        $connection = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
    }
    catch(PDOException $ex)
    {
        die("Failed to connect to the database: " . $ex->getMessage());
    }

    
	/* ============================================
	=
	=	Creating a function so that I can prevent 
	=	backend access when the user uses the console.
	=	with javascript commands.
	*/
	
	
	//for some reason a regular function creation doesn't work.
	if (!function_exists('checkAccess')) {
	    
	    // ... proceed to declare your function
	    function checkAccess($id, $type, $client) {
	    
	    	//include "init.php";
	 
	    	//set their tpye
	    	if ( $type === 'staff') {
	    		$sql= "SELECT * FROM ClientMaster WHERE StaffID = ". $id;
	    	}
	    	if ( $type === 'care') {
	    		$sql= "SELECT * FROM ClientMaster WHERE ClientID = ". $client. " AND  PrimaryCareID= ". $id. " OR SecondCareID = ". $id;
	    	}
	    	if ( $type === 'prov') {
	    		$sql= "SELECT * FROM ClientMaster WHERE ClientID = ". $client. " AND  PrimaryPhyID= ". $id. " OR SecondPhyID= ". $id;
	    	}
	    	
	    	if( $connection->query($sql)->rowCount() < 1) {
	    		return false;
	    	} else {
	    		return true;
	    	}
	    	
	    	
	    	
	    }
	}
	 
	
	
    
    //error mode
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //default fetch
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    //remove magic quotes
    if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
    {
        function undo_magic_quotes_gpc(&$array)
        {
            foreach($array as &$value)
            {
                if(is_array($value))
                {
                    undo_magic_quotes_gpc($value);
                }
                else
                {
                    $value = stripslashes($value);
                }
            }
        }
    
        undo_magic_quotes_gpc($_POST);
        undo_magic_quotes_gpc($_GET);
        undo_magic_quotes_gpc($_COOKIE);
    }
    
    date_default_timezone_set("America/Detroit");
    
    //set the charset to UTF-8	TOOK OUT BECAUSE MESSING WITH HEADER INFORMATION
    //header('Content-Type: text/html; charset=utf-8');
    
    //set the timeout for the sessions, Measured in seconds  900 = 15m / 1800 = 30m / 3600 = 60m 
    ini_set("session.gc_maxlifetime", 15);
    //start the session
    session_start();
    
    
    
    
  
    
    
   
    

    
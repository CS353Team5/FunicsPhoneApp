<?php
    $db_hostname = "mysql.hostinger.co.uk";
	$db_username = "u928551299_admin";
	$db_password = "group5CS353";
	$db_schema = "u928551299_funic"; 

	//in order to start and open a connection to the MySql Server we need to use the function mysql_connect
	//which returns a MySql identifier on success or False on failure
	$connection = @mysql_connect($db_hostname, $db_username, $db_password);
	
	//if one of the parameters in the function mysql_connect is not correct, then we get an error message.
	//And we also use die() to finish the execution
	if(!$connection){
		echo 'Error connecting to the database!';
		die();
	}
	
	// Else, assume it works
	//So if everything is fine, we select the schema/database that we want to work with
	$db = mysql_select_db($db_schema, $connection);
	if(!$db){
		echo "Database cannot be selected";
		die();
	}

//This sql statement is to keep the table without any duplicate user.
//We provide some security methods but to be more secure we just added this statement to avoid any duplication
$duplicateRows = mysql_query("DELETE u1 FROM users u1, users u2 WHERE u1.userID < u2.userID AND u1.userName = u2.userName");
?>
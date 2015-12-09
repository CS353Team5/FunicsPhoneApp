<?php
include("connection.php"); //This is the external file that we use to connect and select the database we want to work with.
session_start();
$userName = ""; //In this variable we will store the username entered by the user which will be compared and checked if it is in the database.
$userPassword= ""; ////In this variable we will store the password entered by the user which will be compared and checked if it is in the database.
$num_rows = 0; //We set the value of num of rows to zero.

if ($_POST['login']){ //This piece of code what it means is that if the sumbit button that has POST method is clicked, then do the following.....
	$userName = $_POST['userName']; //The username entered will be stored in this variable
	$userPassword = $_POST['userPassword']; //The password entered will be stored in this variable

	//If the user does not enter the username or the password, we print a message.
	if(empty($_POST['userName']) || empty($_POST['userPassword'])){
			echo "<p style='margin-left: 600px; position:absolute; padding-top:43px; color:red;'>Missing details!</p>";
	}
	else{	
	//We need to chech if we have a particular user in the database or not. For this, username and password must exist in the database.
	//We form the SQL statement below in order to extract and select all the details entered by users and check them against the users table.
	$sql = " SELECT * FROM users WHERE username = '$userName' AND password = '$userPassword' ";
	$result = mysql_query($sql); //we use this function in order to execute the SQL statement above
	$num_rows = mysql_num_rows($result); //to get the number of rows after executing the SQL statement

	//If the sql statement is not executed successfully, we die the connection.
	if (!$result) {
		echo "Problems found in sql statement";
		die(); //finish execution.
	}	

		//If the sql statement is executed successfully, we check if the user exists in the table users.
		if ($num_rows > 0) { //If there is a user with those details, then the user exists.
			session_start();
			$_SESSION['isLogged'] = $_POST['userName']; //We store the username in the session variable.
			header ("Location: home.php"); //After checking and proving that the user exists, we send her/him to the home page.
			die(); //finish execution.
			}

		//If the user does not exist, we display a message saying that she/he is not registered.
		else if($num_rows == 0){
			header ("Location: reenter.php"); //After checking and the username or password does not exist, we send her/him to the reenter page.
		}
	}
	}
?>
<!DOCTYPE html>
<head>
	<title>Login</title>
	<!--This is the link to the css file-->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Funics</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/register.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 

							<!--Starting point for jQuery Validation Form-->
	<!--Reference for the jquery plugin form validation: https://www.google.ie/#q=jquery+plugin+form+validation-->	
	<!--<link rel="stylesheet" href="style.css">-->
	<script src="../lib/jquery.js"></script>
	<script src="../dist/jquery.validate.js"></script>
	<script>
	</script>
											<!--End point for jQuery Validation Form-->	
</head>
<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Funics</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
					<a href="home.php">Log In</a>
                    </li>
					<li class="page-scroll">
                        <a href="register.php">Sign Up</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">About</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
	<center>
	<form id="loginForm" action="login.php" method="post" style="width: 50%; margin:auto;">
		<fieldset>
		
			<h2>Log In!</h2>
			<hr class="star-primary">
				
				<p>
				<label>Username: </label>
				<input type="text" name="userName">
				<br>
				</p>
				
				<p>
				<label>Password: </label>
				<input type="password" name="userPassword">
				<br>
				</p>
				
				<input type="submit" value="Login" name="login" style="width:130px; color:white; background-color:#2c3e50; border-radius: 15px;"><br>
		</fieldset>
			<br>
			<a href="edit.php" style="color:#2c3e50">Forgot Your Password?</a>
	</form>
	</center>
	</body>
</html>
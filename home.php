<?php 
include("connection.php");

//If the user is registering, in other words if the user pressed the button with name register, 
//we retrieve information posted from login.php.
if($_POST['register']){
//We need to check that users enter valid information So we are using the function preg_match to perform a regular expression match.
//If the expressions do not match, users will not be able to register until they have entered the correct information.
//We make sure that the user enters a valid first name starting with an upper case letter and at least of 2 letters of length.
if(!preg_match("/^[A-Z][a-z]{2,}/", $_POST['fname'])){ 
	echo "<script type='text/javascript'>alert('A valid first name starts with an upper case letter and provides only letters! Please, try again!!'); window.location.href =  'http://phonics.tk/register.php';</script>";
		die(); //finish execution
} else{
$fname = $_POST['fname'];	
}

//We make sure that the user enters a valid last name starting with an upper case letter and at least 2 letters of length.
if(!preg_match("/^[A-Z][a-z]{2,}/", $_POST['lname'])){
	echo "<script type='text/javascript'>alert('A valid last name starts with an upper case letter and provides only letters! Please, try again!!'); window.location.href =  'http://phonics.tk/register.php';</script>";
		die(); //finish execution
} else{
$lname = $_POST['lname'];	
}

//We make sure that the user enters a valid email address by using one of the validate filters that validates whether an email is valid or not.
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	echo "<script type='text/javascript'>alert('Invalid email format! Please, try again!!'); window.location.href = 'http://phonics.tk/register.php';</script>";
	die(); //finish execution
} else{
$email = $_POST['email'];	
}

	//In this part, we check if users are registering with an existing username.
	$NewuserName = $_POST['NewuserName'];
	
	$sql = "SELECT * FROM users WHERE username = '$NewuserName'";
	$result = mysql_query($sql); //we use this function in order to execute the SQL statement above
	$num_rows = mysql_num_rows($result); //This is to check if a new user is trying to register with an username that has been already used.

	if($num_rows > 0){ //If the username entered has been already used by an existing user, then...
		echo "This username is already registered <br>"; //error message.
		echo "You have to <a href='index.php'>Login</a> |or| <a href='index.php'> Register</a>"; //users will be asked to login or register.
		header ("Location: register.php");
		die(); //finish execution.
	}

	//In this part, we check if users are registering with an existing email address.
	$NewuserEmail = $_POST['email'];
	$sql = "SELECT * FROM users WHERE email = '$NewuserEmail'";
	$result = mysql_query($sql); //we use this function in order to execute the SQL statement above
	$num_rows = mysql_num_rows($result); 

	if($num_rows > 0){ //If the email entered has been already used by an existing user, then...
		echo "This email is already registered <br>";
		echo "You have to <a href='index.php'>Login</a> |or| <a href='index.php'> Register</a>";
		header ("Location: register.php");
		die();
	}

	//assuming that everything is good
	session_start();
    $userName = $_SESSION['isLogged'];
	$_SESSION['isLogged'] = $_POST['NewuserName']; //we start a session with the new username.
	

	//The j-query already provides a security method to avoid users of registering with wrong details.
	//In order to be more efficient and provide more security, we are also using the empty php function to double check
	//that everything is filled in.
	//To display error messages, we are using the javacript alert function.
	if(!empty($_POST['fname'])){
	$fname = $_POST['fname'];
	}
	else{
	echo "<script type='text/javascript'>alert('First Name not entered! Please, try again!!'); window.location.href = 'http://phonics.tk/register.php';</script>";
	}

	if(!empty($_POST['lname'])){
	$lname = $_POST['lname'];
	}
	else{
	echo "<script type='text/javascript'>alert('Last Name not entered! Please, try again!!'); window.location.href = 'http://phonics.tk/register.php';</script>";
	}

	if(!empty($_POST['NewuserName'])){
    $NewuserName = $_POST['NewuserName'];
	}
	else{
	echo "<script type='text/javascript'>alert('Username not entered! Please, try again!!'); window.location.href = 'http://phonics.tk/register.php';</script>";	
	}

	if(!empty($_POST['NewuserPassword'])){
        $NewuserPassword = $_POST['NewuserPassword'];
    }
	else{
	echo "<script type='text/javascript'>alert('Password not entered! Please, try again!!'); window.location.href = 'http://phonics.tk/register.php';</script>";	
	}

	if(!empty($_POST['email'])){
	$email = $_POST['email'];
	}
	else{
	echo "<script type='text/javascript'>alert('Email not entered! Please, try again!!); window.location.href = 'http://phonics.tk/register.php';</script>";	
	}

	if(!empty($_POST['phone'])){
	$phone = $_POST['phone'];
	}
	else{
	echo "<script type='text/javascript'>alert('Phone not provided'); window.location.href = 'http://phonics.tk/register.php';</script>";	
	}
	
	if(!empty($_POST['age'])){
	$age = $_POST['age'];
	}
	else{
	echo "<script type='text/javascript'>alert('Age not provided'); window.location.href = 'http://phonics.tk/register.php';</script>";	
	}

	if(!empty($_POST['gender'])){
	$gender = $_POST['gender'];
	}
	else{
	echo "<script type='text/javascript'>alert('Gender not specified'); window.location.href = 'http://phonics.tk/register.php';</script>";
	}

	//This is to double check again that both passwords entered by the user match.
	if($_POST['NewuserPassword'] != $_POST['confirm_password']){
	echo "<script type='text/javascript'>alert('Passwords do not match');</script>";	
	}

	

	//else...passwords match, keep going
	//Before inserting new registering details, we check that nothing is empty.
	//If everything is fine we proceed to insert new users details in the table called users.
	if(!empty($fname) && !empty($lname) && !empty($NewuserName) && !empty($NewuserPassword)&& !empty($email) && !empty($gender) && !empty($age) && !empty($phone)){
	$sql = "INSERT INTO users VALUES('$fname', '$lname', '$NewuserName', '$NewuserPassword', '$email', '$gender', '$age', '$phone')";
	$addUser = @mysql_query($sql);
    }
    else{
    	echo "<script type='text/javascript'>alert('Make sure you are not leaving blank spaces');</script>";	
    }  
    }

    if($_SESSION['isLogged'] = ""){
		echo "You have to <a href='index.php'>Login Or Register</a>";
			header ("Location: index.php"); //Register or Login.
			die();
	} 
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Funics</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

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

</head>

<body>
	
	
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
					<a href="index.php">Log out</a>
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
	
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-text">
                        <span class="name" style="font-size:50px">Welcome to your page!</span>
                        <hr class="star-primary">
                    </div>
                </div>
            </div>
        </div>
    </header>

	<!-- TextArea Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Start Learning!</h1>
                    <hr class="star-primary">
                </div>
            </div>
			<div>
			<center>
			<form> 
				Enter your phrase here:<br>
				<input type="text" name="text" id="text">
				<br>
				
				<select id="speed" class = "left">
				
				<option value = "1.5">Fast</option>
				<option value = "1.0" selected="selected">Normal</option>
				<option value = "0.5">Slow</option>

				
				</select>
			
				<br>
				<input 
					onclick='responsiveVoice.speak(document.getElementById("text").value,"UK English Female",{rate: document.getElementById("speed").value});'
					type="button" 
					value="Play" 
					name="play" 
					style="width:130px; margin-left:0px; color:white; background-color:#2c3e50; border-radius: 15px;">
				<input
					onclick='responsiveVoice.cancel();'
					type="button" 
					value="Stop" 
					name="stop" 
					style="width:130px; margin-left:10px; color:white; background-color:#2c3e50; border-radius: 15px;">
				<input
					onclick =""
					type="button" 
					value="Save" 
					name="save" 
					style="width:130px; margin-left:10px; color:white; background-color:#2c3e50; border-radius: 15px;"><!--onclick='save phrase'-->
				
				</form>
				</center>
			</div>
        </div>
    </section>
	<section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Recent Searches:</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <p>See your most recent searches here:</p>
				<ul class="recent">
                    <li>
                        Search 1
                    </li>
                    <li>
						Search 2
                    </li>
                    <li>
                        Search 3
                    </li>
                </ul>	
        </div>
    </section>
	
	<!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Location</h3>
                        <p>Maynooth University<br>Maynooth, Co. Kildare</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                            </li>
                        </ul>
                    </div>
					<div class="footer-col col-md-4">
                        <h3>Contact Us</h3>
                        <p>Email:   funics@notreal.com</p>
						<p>Phone:   12 345 6789</p><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Funics 2015
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
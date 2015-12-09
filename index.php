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
<html lang="en">

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
					<a href="login.php">Log In</a>
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

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="img/Logo.png" alt="">
                    <div class="intro-text">
                        <span class="name">Welcome!</span>
                        <hr class="star-primary">
                        <span class="skills">Interactive Speech Development Tool</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

	<!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>Funcis is an interactive tool designed to help those with a speech disability, or those who are struggling with English, develop their speech.</p>
                </div>
                <div class="col-lg-4">
                    <p>To have a go, just type a phrase, or a word, or a sentence, or anything you want really, into the text into the textbox and hit play. Make sure your volume is turned up!</p>
                </div>
            </div>
        </div>
    </section>
	
	
    <!-- TextArea Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Have a Go!</h2>
                    <hr class="star-primary">
                </div>
            </div>
			<!--Original Code-->
			<div>
				<center>
				<form id="loginForm" action="login.php" method="post">
				Enter some text here and hit play!<br>
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
				
				</form>
				</center>
			</div>
			<!--Original Code End-->
            </div>
        </div>
    </section>

    <!-- Create Account Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Create an Account Today!</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
					<p>Create an account to get access to extra features! You can save your favourite phrases, look through your history 
					and see a personalised homepage. The Funics team are looking forward to enhancing the user experience even more in the 
					future so there's lots more to come. Don't hesitate to contact us with any queries or problems you may have. For recent 
					news and updates check out our facebook page or twitter accounts. We hope you enjoy learning with Funics!</p>
                </div>
            </div>
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

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>

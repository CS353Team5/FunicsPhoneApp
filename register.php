<?php
include("connection.php"); //This is the external file that we use to connect and select the database we want to work with.
session_start();
$userName = ""; //In this variable we will store the username entered by the user which will be compared and checked if it is in the database.
$userPassword = ""; ////In this variable we will store the password entered by the user which will be compared and checked if it is in the database.
$num_rows = 0; //We set the value of num of rows to zero.
?>	
<!DOCTYPE html>
<head>
	<title>Sign Up</title>
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
	$.validator.setDefaults({
		submitHandler: function() {
			alert("submitted!");
		}
	});

	//We use several functions to validate the form.
	//Every part of the registration form must be filled in. 
	//If the user is leaving blank spaces or entering unvalidated information, he/she will be warned by messages that
	//will be displayed under the field where they are making the mistake(s).
	$().ready(function() {
		// validate signup form on keyup and submit.
		$("#signupForm").validate( {
			rules: {
				fname:{
					required: true, //First name is a mandatory field so that the user must enter his/her first name.
					minlength: 2 //First name has to be a minimum of 2 characters.
				},

				lname:{
					required: true, //Last name is a mandatory field so that the user must enter his/her first name.
					minlength: 2 //Last name has to be a minimum of 2 characters.
				},

				NewuserName: {
					required: true, //Username is a mandatory field so that the user must enter a username or use the one that was proposed in the form (firstName + lastName).
					minlength: 6 //Username has to be a minimum of 6 characters.
				},
				NewuserPassword: { 
					required: true, //A password is a mandatory field so that the user must enter a password.
					minlength: 6 //The password has to be a minimum of 6 characters.
				},
				confirm_password: { 
					required: true, //The confirmation password is a mandatory field so that the user must enter a second password.
					minlength: 6, //The confirmation password has to be a minimum of 6 characters.
					equalTo: "#NewuserPassword" //Both passwords entered must match.
				},

				//To begin with, it should be emphasized that this j-query validation plugin does not support radio buttons or select lists.
				gender: {
				required: true, //The gender is also mandatory and users must specify their sex. 
				gender : true //This is a radio button. Therefore, when the warning message is displayed, this one will
				}, //not dissapeared even if the user has specified his/her sex.

				nation: { 
				required: true, //Nation is also required.
				nation: true
				},

				dob: {
					required: true //Date of Birth is also required.
				},

				phone: { 
				required: true, //Phone number must also be provided by the user.
				minlength: 9, //The phone number has to be at least 9 digits.
				digits: 9 //The phone number has to be only and at least 9 digits. No letters.
				},

				email: {
					required: true, //Users have to enter a valid email address.
					email: true // [a-z][0-9] + @ + hotmail/gmail/outlook and so on + . + com/ec/es/ and so on.
				},
				agree: "required"
			},
			//These are the messages that will be displayed for every field when users do no enter the right information.
			messages: {
				fname:{
					required: "Please enter your name <br> A valid first name starts with an upper case letter and provides only letters!",
					minlength: "Your name must consist of at least 2 letters"
				},
				lname:{
					required: "Please enter your last name <br> A valid last name starts with an upper case letter and provides only letters!",
					minlength: "Your name must consist of at least 2 letters"
				},
				NewuserName: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 6 characters"
				},
				NewuserPassword: {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long",
					equalTo: "Please enter the same password as above"
				},

				phone : {
					required: "Provide a phone number",
					digits: "Please enter only digits.",
					minlength : "Please enter at least 9 numbers"
				},

				dob: {
				required: "Please enter your date of birth",
				date: "Please enter a valid date."
			},

				email: "Please enter a valid email address. <br> Format: youremail@outlook.com"			
			}
		});

		// Here we propose username by combining first and lastname which were entered by the user.
		$("#NewuserName").focus(function() {
			var fname = $("#fname").val();
			var lname = $("#lname").val();
			if (fname && lname && !this.value) {
				this.value = fname + "." + lname;
			}
		});
	});
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
	

	<div id="page" style="position=absolute;">


											<!--Starting point of sign up system-->
	<form class="cmxform" id="signupForm" method="post" action="home.php" style="width: 50%; margin:auto;">
			<center><fieldset>
			<div class="col-lg-12 text-center">
                    <h2>Register Now!</h2>
                    <hr class="star-primary">
                </div>
			<p>
				<label for="fname">Firstname</label>
				<input id="fname" name="fname" type="text">
			</p>

			<p>
				<label for="lname">Lastname	</label>
				<input id="lname" name="lname" type="text">
			</p>


			<p>
				<label for="email">Email	</label>
				<input id="email" name="email" type="email">
			</p>

			<p>
				<label for="phone">Phone	</label>
				<input id="phone" name="phone" type="text">
			</p>

			<p>
				<label for="dob">Age</label>
				<input type="text" id="age" name="age">
			</p>

			<p>
				<label for="NewuserName">Username	</label>
				<input id="NewuserName" name="NewuserName" type="text">
			</p>
			<p>
				<label for="NewuserPassword">Password	</label>
				<input id="NewuserPassword" name="NewuserPassword" type="password">
			</p>
			<p>
				<label for="confirm_password">Confirm password	</label>
				<input id="confirm_password" name="confirm_password" type="password">
			</p>
			<p>
				<input type="radio" id="gender" name="gender" value="male" checked>Male
				<input type="radio" id="gender" name="gender" value="female" checked>Female
			</p>

			<p>
				<input class="submit" type="submit" value="Sign Up" name="register" style="width:130px; color:white; background-color:#2c3e50; border-radius: 15px;">
			</p>
		</fieldset></center>
	</form>
											<!--End point of sign up system-->
	</div>
</body>
</html>
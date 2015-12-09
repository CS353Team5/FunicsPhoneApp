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
<style>

</style>
	<title>Home</title>
	
	<!--Links to CSS and JS-->
	<link rel="stylesheet" href="basic.css"> <!-- CSS -->
	<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
	<!--<script language="javascript" type="text/javascript" src="js/slideshow.js"></script>-->
</head>

<body>
    <h1> Welcome <?php 
	echo $_SESSION['isLogged'];
	?></h1>
	<h1>FUNICS!!</h1> <!--Logo-->
	<p>Welcome to FUNICS!<br>
	An online learning resource for those having difficulty with speech and pronunciation. <br>
	Please feel free to try out our app now, or make an account for access to extra features.<br></p>
	
	
	<br>
	
	<textarea id= "text" rows="10" cols="40" class="center">
Please enter the text you'd like to hear back in this box!</textarea>	
	
	<select id="speed" class = "left">
	<option value = "1.5">Fast</option>
	<option value = "1.0">Normal</option>
	<option value = "0.5">Slow</option>
	</select>
	
	<br>
	<br>
	<input
		onclick='responsiveVoice.speak(document.getElementById("text").value,"UK English Female",{rate: document.getElementById("speed").value});'
		type="button" 
		value="Play" 
		class= "left"
	/>
	<input
		
		onclick='responsiveVoice.cancel();'
		type="button"
		value="Stop"
	/>

	<br>
</body>

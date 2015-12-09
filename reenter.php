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
<html>
<head>
	<title>Phonics</title>


											<!--End point for jQuery Validation Form-->	
</head>
<body>
										<!--Starting point for FACEPILE API-->
	<!--Reference for the jquery plugin form validation: https://developers.facebook.com/docs/plugins/page-plugin-->	
	<script>
  	window.fbAsyncInit = function() {
    FB.init({
      appId      : '1577898179128334',
      xfbml      : true,
      version    : 'v2.3'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
	</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1577898179128334";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div style="float: right;" class="fb-page" data-href="https://www.facebook.com/tasomapp?skip_nax_wizard=true&amp;ref_type=registration_form" data-width="130" data-height="200" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/tasomapp?skip_nax_wizard=true&amp;ref_type=registration_form"><a href="https://www.facebook.com/tasomapp?skip_nax_wizard=true&amp;ref_type=registration_form">TASOMapp</a></blockquote></div></div>
											<!--End point for FACEPILE API-->

	<div id="page" style="position=absolute;">

											<!--Starting point of login system-->
<form id="loginForm" action="reenter.php" method="post" style="width: 50%; margin:auto;">
<fieldset>
	<legend style="margin:auto; color:blue; font-size:30px;">LOG-IN!</legend>
	Your username <input type="text" name="userName"><br>
	Your password <input type="password" name="userPassword"><br>
	<input type="submit" value="Login" name="login" style="width:15%; margin-left:125px;  color:white; background-color:#0033FF; border-radius: 15px;"><br>
	<a href="edit.php"><p>Forgot Your Password?</p></a>
</fieldset>
</form>
</body>
</html>
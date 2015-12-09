
<!DOCTYPE HTML>
<html>
<head>
<Title>Forgot Your Password</Title>
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" href="font.css" type="text/css"/>	

<!--REFERENCE: TUTORIAL FROM: http://cssmenumaker.com/menu/tabbed-menu# -->		
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript">	
( function( $ ) {
$( document ).ready(function() {
$('#menu').prepend('<div id="bg-one"></div><div id="bg-two"></div><div id="bg-three"></div><div id="bg-four"></div>');
});
} )( jQuery );
</script>

</head>

<body>


<h1>Forgot Password? </h1>
<div id="edit_form">
<form action="edit.php" method="post" id="getForm">
 Your Email: <input type="text" name="email"><br>
<input class= "submit" type="submit" value="Send"/>
</form>
</div>
<?php
//check if user entered their email
 if(isset($_POST['email'])){
 $email=$_POST['email'];
 //collect all informatio  regarding the email ie username and password of the email is in the database
 $sql= "SELECT username, password FROM users WHERE email = '$email'";
 $result_display = @mysql_query($sql);

    while($row = mysql_fetch_array($result_display)){
        $userName = $row['username'];
		$password = $row['password'];
	}	
 if(!$result_display){
	 echo "Email Doesn't Exist";
	 die();
 }	

//send information  to users email
    $subject = 'Phonics Request For Username And Password';
    $message = "Your UserName is: ".$userName." And Your Password is ".$password;
    $headers = 'From: phonics@gmail.com' . "\r\n" .
        'Reply-To: phonics@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($email, $subject, $message, $headers); 

    echo 'Email Sent. Check Your Spam';
 }
?>
</body>
</Html>
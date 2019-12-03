<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Accordion - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
  </script>
  
  <style>
	* {
		font-family: Arial, Helvatical, sans-serrif;
	}
  
  </style>
</head>
<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db_connect.php";
$username = $_POST['username'];
$password = $_POST['password'];

echo "YOu attempted to login with ". $username. " ".$password;

// search the database for the word chicken
$stmt = $mysqli -> prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt -> bind_param("s", $username);

$stmt ->execute();
$stmt -> store_result();
$stmt ->bind_result($userid, $uname, $pw);
if($stmt->num_rows ==1)
{
	echo " found 1 person with that username<br>";
	$stmt->fetch();
	if(password_verify($password, $pw))
	{
		echo"the password matched<br>";
		echo "login success";
		$_SESSION['username'] = $uname;
		$_SESSION['userid'] = $userid;
		exit;
	}
	else{
		
		$_SESSION = [];
		session_destroy();
		echo "<br><a href = 'index.php'> return to main page</a>";
	}
}
else {
	$_SESSION = [];
	session_destroy();
	echo "<br><a href = 'index.php'> return to main page</a>";
	
}
echo "login failed";
//$sql = "SELECT id,username, password FROM users WHERE username = '$username' AND password = '$password'";

?>

<div id="accordion">

<?php

echo "SESSION = <br>";
echo "<pre>";
print_r($_SESSION);
echo"</pre>";

?>
</div>
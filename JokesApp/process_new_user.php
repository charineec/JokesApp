<?php
include "db_connect.php";

$new_username = $_POST['username'];
$new_password1 = $_POST['password1'];
$new_password2 = $_POST['password2'];

$hashed_password = password_hash($new_password1, PASSWORD_DEFAULT);
echo "<h2> trying to add a new user". $new_username.$new_password1.$new_password2." </h>";

if($new_password1 != $new_password2)
{
	echo "The password do not match. Please try again";
	exit;
}
preg_match('/[0-9]+/', $new_password1, $matches);
if(sizeof($matches) == 0)
{
	echo "The password must have at least one number <br>";
	exit;
}
preg_match('/[!@#$%^&*()]+/', $new_password1, $matches);
if(sizeof($matches) == 0)
{
	echo "The password must have at least one special character <br>";
	exit;
}
if(strlen($new_password1) <= 8)
{
	echo "The password must be at least 8 characters <br>";
	exit;
}

$sql = "SELECT * FROM users WHERE username = '$new_username'";
$result = $mysqli->query($sql) or die(mysqli_error($mysqli));
if($result-> num_rows > 0)
{
	echo "The username ". $new_username. " is already taken";
	exit;
}

// insert new user
$stmt = $mysqli->prepare("INSERT INTO users (id, username, password)
 VALUES (null, ?, ?)");
$stmt->bind_param("ss", $new_username, $hashed_password);
$result = $stmt->execute();
if($result)
{
	echo "sucess";
}
else
{
	echo "failed";
}

echo "<a href='index.php'> Return to main</a>";
?>
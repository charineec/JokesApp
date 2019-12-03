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

include "db_connect.php";

$keyword = addslashes($_GET["keyword"]);
// search the database for the word chicken
echo "<h2>Show all jokes with the word ".$keyword."</h2>";
$keyword = "%".$keyword."%";
$stmt = $mysqli->prepare("SELECT jokes_table.JokeID, 
jokes_table.Joke_question, jokes_table.Joke_answer, jokes_table.users_id , google_users.google_name
FROM google_users
INNER JOIN Jokes_table ON google_users.google_id = jokes_table.users_id
WHERE Joke_question LIKE ?");

$stmt->bind_param("s", $keyword	);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($JokeID, $Joke_question, $Joke_answer, $userid, $username);



?>

<div id="accordion">

<?php
if ($stmt->num_rows > 0) {
    // output data of each row
    while($stmt->fetch()) {
        $safe_joke_question = htmlspecialchars($Joke_question);
		$safe_joke_answer = htmlspecialchars($Joke_answer);
		
		echo "<h3>$safe_joke_question</h3>";
		echo "<div><p> $safe_joke_answer -- Submitted by $username </p></div>";
	}
} else {
    echo "0 results";
}
?>
</div>
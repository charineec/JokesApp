<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors',1);
//session_start();


include "db_connect.php";

$new_joke_question = addslashes($_GET["newJoke"]);
$new_joke_answer = addslashes($_GET["newAnswer"]);
$userid = $_SESSION['userid'];
// search the database for the word chicken
echo "<h2>Trying to add a new joke: $new_joke_question and $new_joke_answer</h2>";
$stmt= $mysqli->prepare("INSERT INTO jokes_table(Joke_question, Joke_answer, users_id) 
VALUES (?,?,?)");
$stmt->bind_param("ssi", $new_joke_question, $new_joke_answer, $userid);
$stmt->execute();
$stmt->close();
echo $mysqli->error;
include "search_all_jokes.php";


?>
<a href="index.php">Return to main page</a>
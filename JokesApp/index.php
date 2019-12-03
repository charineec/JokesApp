<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<h1>Joke Page</h1>
<?php
include "db_connect.php";

//include "search_all_jokes.php";
?>

<form class="form-horizontal" action="search_keyword.php">
<fieldset>

<!-- Form Name -->
<legend>Search for a Joke</legend>

<!-- Search input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="keyword">Search Input</label>
  <div class="col-md-4">
    <input id="keyword" name="keyword" type="search" placeholder="e.g. chicken" class="form-control input-md">
    <p class="help-block">Enter text to search for jokes in the database</p>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-info">search</button>
  </div>
</div>

</fieldset>
</form>


<hr>
<?php
session_start();
if(isset($_SESSION['userid'])):
?>
<form class="form-horizontal" action="add_joke.php">
<fieldset>

<!-- Form Name -->
<legend>Add a joke</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newJoke">New joke</label>  
  <div class="col-md-6">
  <input id="newJoke" name="newJoke" type="text" placeholder="" class="form-control input-md">
  <span class="help-block">Enter the first half of your joke</span>  
  </div>
</div>

<!-- Search input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newAnswer">Joke answer</label>
  <div class="col-md-5">
    <input id="newAnswer" name="newAnswer" type="search" placeholder="" class="form-control input-md">
    <p class="help-block">Enter the answer to your joke</p>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">submit</button>
  </div>
</div>

</fieldset>
</form>
<?php
//include "search_keyword.php";

$mysqli->close();
else:

?>
<div align="center">
<h3>Login</h3>
<div>You will need a Google account to add a new joke.</div>
<a href="google_login.php">Login Here</a>
</div>
<?php endif; ?>

</body>


</html>
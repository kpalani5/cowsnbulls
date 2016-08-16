<?php
	include("session.php");
?>
<html>
	<head>
			<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			<style>
				body
				{
					background: url('backg.jpg');
				}
				.jumbotron
				{
    			background-color:black;
    			text-align:center;
				}
				.headtext
				{
					color: gold;
					font-style: oblique;
					font-weight: bold;
					font-family: "Comic Sans MS", cursive, sans-serif;
				}

				ul {
				    list-style-type: none;
				    margin: 0;
				    padding: 0;
				    width: auto;
						height: 100%;
				    background-color: black;

				}

				.table
				{
					border-color: red;
				}

				.table_txt
				{
					color: red;
					font-style: oblique;
					font-weight: bold;
					font-family: "Comic Sans MS", cursive, sans-serif;
				}

			</style>
		<title>Cows N Bulls</title>
	</head>
	<body>
		<form action = "account_settings.php" method = "POST">
		<div class = "jumbotron">
		<center> <h2 class = "headtext"> ACCOUNT SETTINGS </h2> </center>
	</div>
  <div class = "row">
  <div class = "col-sm-4"> </div>
  <div class = "col-sm-4">
    <br>
    <br>
    <center>
      <table class = "table table-bordered">
				<tr>
				<td class = "table_txt"> OLD PASSWORD: </td>
				<td> <input type = "password" name = "old_password" id = "old_password"> </td>
			</tr>
			<tr>
			<td class = "table_txt"> NEW PASSWORD: </td>
			<td> <input type = "password" name = "new_password" id = "new_password"> </td>
		</tr>
		<tr>
		<td class = "table_txt"> CONFIRM NEW PASSWORD: </td>
		<td> <input type = "password" name = "confirm_password" id = "confirm_password"> </td>
	</tr>
			</table>
  </center>
  </div>
<div class = "col-sm-4"> </div>
</div>
<br>
<center>
	<input type = "submit" value = "CHANGE PASSWORD" class = "btn btn-lg btn-success">
</center>
</form>
<br>
<form action = "home.php" method = "post">
	<center>
		<input type = "submit" value = "CANCEL" class = "btn btn-lg btn-success">
	</center>
</form>
</body>
</html>

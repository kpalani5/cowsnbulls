<?php

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
	font-style: oblique;
	font-weight: bold;
	font-family: "Comic Sans MS", cursive, sans-serif;
	color: gold;
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
option, select
{
	color: white;
	background-color: black;
	font-style: italic;
	font-weight: bold;
	font-family: "Verdana", cursive, sans-serif;
}
</style>
		<title>Cows N Bulls</title>
	</head>
	<body>
		<div class = "jumbotron">
		<center> <h2 class = "headtext"> Game Selection </h2> </center>
	</div>
	<br>
		<br>
		<center>
			<div class = "row">
				<div class = "col-sm-4"></div>
				<div class = "col-sm-4">
		<form action = "pre_game.php" method = "post">
			<table class = "table table-bordered">
				<tr>
				<td class = "table_txt"> LEVEL: </td>
				<td>
				<select name = "level">
					<option value = "Easy"> Easy </option>
					<option value = "Hard"> Hard </option>
				</select>
				</td>
				</tr>
				<tr>
				<td class = "table_txt"> MODE: </td>
				<td>
				<select name = "mode">
					<option value = "Freestyle"> Freestyle </option>
					<option value = "Counter"> Counter </option>
					<option value = "Timer"> Timer </option>
					<option value = "Sequence"> Sequence </option>
				</select>
				</td>
				</tr>
				<tr>
				<td class = "table_txt"> LETTER COUNT: </td>
				<td>
				<select name = "letter">
					<option value = "Four"> Four </option>
					<option value = "Five"> Five </option>
				</select>
				</td>
				</tr>
			</table>
		</div>
		<div class = "col-sm-4"></div>
	</div>
			<br>
			<br>
			<input type = "hidden" value = "" name = "seq_id">
			<input type = "submit" value = "PLAY" class = "btn btn-success btn-lg">
		</form>
		<br>
		<br>
		<form action = "home.php" method = "post">
			<input type = "submit" class = "btn btn-success btn-lg" value = "BACK TO HOMEPAGE" id = "backbutton">
		</form>
		</center>
	</body>
</html>

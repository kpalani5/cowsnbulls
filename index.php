<?php
	include("config.php");
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql = "SELECT * FROM login WHERE Username = '$username';";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$pass = $row["Password"];
		if(hash_equals($pass,crypt($password,$pass)))
		{
			$_SESSION["login_user"] = $username;
			header('Location: home.php');
		}
	}
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
		</style>
		<title>Cows N Bulls</title>
	</head>
	<body>
		<center>
			<div class = "jumbotron">
		<h2 class = "headtext"> COWS AND BULLS </h2>
		</div>
		</br></br>
		<div class = "row">
			<div class = "col-sm-4"> </div>
			<div class = "col-sm-4">
		<form action = "index.php" method = "post">
		<table class = "table table-bordered">
			<tr>
				<td class = "table_txt"> USERNAME </td>
				<td> <input type = "text" name = "username"> </td>
			</tr>
			<tr>
				<td class = "table_txt"> PASSWORD </td>
				<td> <input type = "password" name = "password"> </td>
			</tr>
		</table>
			<input type = "submit" value = "LOGIN" class = "btn btn-success btn-lg">
		</form>
	</div>
	<div class = "col-sm-4"> </div>
</div>
		</br></br>
		<a href = "register.php" class = "btn btn-success btn-lg"> New to the game? Click here to register </a>
		</center>
	</body>
</html>

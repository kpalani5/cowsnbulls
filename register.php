<?php
	include("config.php");
    if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		$confirm = $_POST["confirm"];
		$user_count = 0;
		$email_count = 0;

		if (isset($_POST['username']))
		{
			$sql = "SELECT count(*) FROM user WHERE username='$username';";
			$sql2 = "SELECT count(*) FROM user WHERE email='$email';";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$result2 = mysqli_query($db,$sql2);
			$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
			$user_count = $row["count(*)"];
			$email_count = $row2["count(*)"];
		}

		if($user_count == 0 && $email_count == 0 && $password === $confirm)
		{
			$cost = 10;
			$salt = strtr(base64_encode(mcrypt_create_iv(16,MCRYPT_DEV_URANDOM)),'+','.');
			$salt = sprintf("$2a$%02d$",$cost).$salt;
			$hash = crypt($password,$salt);
			$sql = "INSERT INTO login VALUES ('$username','$hash','user');";
			$sql2 = "INSERT INTO user VALUES ('$username','$email',now());";
			mysqli_query($db,$sql2);
			mysqli_query($db,$sql);
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
		<center> <h2 class = "headtext"> Registration </h2> </center>
	</div>
		<div class = "row">
			<div class = "col-sm-4"></div>
			<div class = "col-sm-4">
		<form action = "register.php" method = "post">
			<table class = "table table-bordered">
			    <?php
				if($_SERVER["REQUEST_METHOD"] == "POST")
				{
					if($user_count > 0)
					{
						echo "<div> USERNAME NOT AVAILABLE</div>";
					}
					if($email_count > 0)
					{
						echo "<div> USER WITH THIS EMAIL IS ALREADY REGISTERED </div>";
					}
					if($password !== $confirm)
					{
						echo "<div> PASSWORDS DO NOT MATCH </div>";
					}
					if($user_count == 0 && $email_count == 0 && $password === $confirm)
					{
						echo "<div> SUCCESSFULLY REGISTERED </div>";
					}
				}
				?>
				<tr>
					<td class = "table_txt"> Username: </td>
					<td> <input type = "text" name = "username" required> </td>
					<td> <div id = "user_status"> </div> </td>
				</tr>
				<tr>
					<td class = "table_txt"> Email ID: </td>
					<td> <input type = "email" name = "email"> </td>
				</tr>
				<tr>
					<td class = "table_txt"> Password: </td>
					<td> <input type = "password" name = "password" id = "password" required> </td>
				</tr>
				<tr>
					<td class = "table_txt"> Confirm Password: </td>
					<td> <input type = "password" name = "confirm" id = "confirm" required> </td>
				</tr>
			</table>
			<input type = "submit" value = "REGISTER" class = "btn btn-success btn-lg">
		</form>
	</div>
	<div class = "col-sm-4"></div>
</div>
		<br>
		<br>
			<a href = "index.php" class = "btn btn-success btn-lg"> Back to Login Page </a>
		</center>
	</body>
</html>

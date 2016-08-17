<?php
	include("config.php");
	include("session.php");
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_SESSION['login_user'];
		$old_password = $_POST["old_password"];
		$new_password = $_POST["new_password"];
		$confirm_password = $_POST["confirm_password"];
		$pass_count = 0;
		$sql = "SELECT * FROM login WHERE Username = '$username';";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$pass = $row["Password"];
		if(hash_equals($pass,crypt($old_password,$pass)))
		{
			$pass_count = 1;
		}
		if($pass_count == 1 && $new_password === $confirm_password)
		{
			$cost = 10;
			$salt = strtr(base64_encode(mcrypt_create_iv(16,MCRYPT_DEV_URANDOM)),'+','.');
			$salt = sprintf("$2a$%02d$",$cost).$salt;
			$hash = crypt($new_password,$salt);
			$sql = "UPDATE login SET Password = '$hash' WHERE Username = '$username';";
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
				<?php
			if($_SERVER["REQUEST_METHOD"] == "POST")
			{
				if($pass_count != 1)
				{
					echo "<div> INVALID OLD PASSWORD </div>";
				}
				if($new_password !== $confirm_password)
				{
					echo "<div> PASSWORDS DO NOT MATCH </div>";
				}
				if($pass_count == 1 && $new_password === $confirm_password)
				{
					echo "<div> PASSWORD SUCCESSFULLY CHANGED </div>";
				}
			}
			?>
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
		<input type = "submit" value = "BACK TO HOMEPAGE" class = "btn btn-lg btn-success">
	</center>
</form>
</body>
</html>

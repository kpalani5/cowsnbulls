<?php
	include("config.php");
    if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		$confirm = $_POST["confirm"];
		//Check if username is available - PHP Ajax JQuery
		//Check email format - HTML5, availability - PHP Ajax JQuery
		//Check if password is confirmed - PHP for server side and JS for client side
		if($_POST['password'] !== $_POST['confirm'])
		{
			
		}
		//Check password strength - PHP and JQuery
		else
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
	<script>
		function validate()
		{
			if(document.getElementById("password").value != document.getElementById("confirm").value)
			{
				document.getElementById('error').innerHTML = "Passwords do not match."
				document.getElementById('password').value='';
				document.getElementById('confirm').value='';
			}
		}
		
	</script>
	<body>
		<center>
		<center> <h1> Registration </h1> </center>
		<form action = "register.php" method = "post">
			<table>
			    <tr>
					<td> <div id = "error"> </div> </td>
				</tr>
				<tr>
					<td> Username: </td>
					<td> <input type = "text" name = "username"> </td>
				</tr>
				<tr>
					<td> Email ID: </td>
					<td> <input type = "email" name = "email"> </td>
				</tr>
				<tr>
					<td> Password: </td>
					<td> <input type = "password" name = "password" id = "password"> </td>
				</tr>
				<tr>
					<td> Confirm Password: </td>
					<td> <input type = "password" name = "confirm" id = "confirm"> </td>
				</tr>
			</table>
			<input type = "submit" value = "Register" onclick = "validate(); return false;">
		</form>
		</center>
	</body>
</html>
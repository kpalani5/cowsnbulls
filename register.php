<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$cost = 10;
		$salt = strtr(base64_encode(mcrypt_create_iv(16,MCRYPT_DEV_URANDOM)),'+','.');
		$salt = sprintf("$2a$%02d$",$cost).$salt;
		$hash = crypt($password,$salt);			
	}
?>
<html>
	<body>
		<center>
		<center> <h1> Registration </h1> </center>
		<form action = "" method = "post">
			<table>
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
					<td> <input type = "password" name = "password"> </td>
				</tr>
				<tr>
					<td> Confirm Password: </td>
					<td> <input type = "password" name = "confirm"> </td>
				</tr>
			</table>
			<input type = "submit" value = "Register">
		</form>
		</center>
	</body>
</html>
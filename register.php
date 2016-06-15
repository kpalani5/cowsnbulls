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
		//Check if username is available - PHP 
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
			if($user_count > 0) 
			{
				echo "<div> Username Not Available.</div>";
			}
			else if($email_count > 0)
			{
				echo "<div> User with this email is already registered. </div>";
			}
		}
		
		//Check email format - HTML5
		
		//Check if password is confirmed - PHP for server side and JS for client side
		if($_POST['password'] !== $_POST['confirm'])
		{
			echo "<div> Passwords do not match.</div>";
		}
		
		//Check password strength - PHP and JQuery
		
		else if($user_count == 0 && $email_count == 0)
		{
			$cost = 10;
			$salt = strtr(base64_encode(mcrypt_create_iv(16,MCRYPT_DEV_URANDOM)),'+','.');
			$salt = sprintf("$2a$%02d$",$cost).$salt;
			$hash = crypt($password,$salt);
			$sql = "INSERT INTO login VALUES ('$username','$hash','user');";
			$sql2 = "INSERT INTO user VALUES ('$username','$email',now());";
			mysqli_query($db,$sql2);
			mysqli_query($db,$sql);		 
			echo "<div> Successfully Registered!</div>";
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
				return false;
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
					<td> <div id = "user_status"> </div> </td>
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
					<td> <input type = "password" name = "confirm" id = "confirm" onblur = "validate();"> </td>
				</tr>
			</table>
			<input type = "submit" value = "Register">
		</form>
		</center>
	</body>
</html>
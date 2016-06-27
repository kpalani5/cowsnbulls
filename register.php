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
		<title>Cows N Bulls</title>
	</head>
	<body>
		<center>
		<center> <h1> Registration </h1> </center>
		<form action = "register.php" method = "post">
			<table>
			    <?php 
				if($_SERVER["REQUEST_METHOD"] == "POST")
				{
					if($user_count > 0) 
					{
						echo "<div> Username Not Available.</div>";
					}
					if($email_count > 0)
					{
						echo "<div> User with this email is already registered. </div>";
					}
					if($password !== $confirm)
					{
						echo "<div> Passwords do not match.</div>";
					}
					if($user_count == 0 && $email_count == 0 && $password === $confirm)
					{
						echo "<div> Successfully Registered!</div>";
					}
				}
				?>
				<tr>
					<td> Username: </td>
					<td> <input type = "text" name = "username" required> </td>
					<td> <div id = "user_status"> </div> </td>
				</tr>
				<tr>
					<td> Email ID: </td>
					<td> <input type = "email" name = "email"> </td>
				</tr>
				<tr>
					<td> Password: </td>
					<td> <input type = "password" name = "password" id = "password" required> </td>
				</tr>
				<tr>
					<td> Confirm Password: </td>
					<td> <input type = "password" name = "confirm" id = "confirm" required> </td>
				</tr>
			</table>
			<input type = "submit" value = "Register">
		</form>
		</center>
	</body>
</html>
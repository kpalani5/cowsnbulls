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
		<title>Cows N Bulls</title>
	</head>
	<body>
		<center>
		<h1>
			<?php echo("COWS AND BULLS"); ?>
		</h1>
		</br></br>
		<form action = "index.php" method = "post">
		<table>
			<tr> 
				<td> Username </td> 
				<td> <input type = "text" name = "username"> </td>
			</tr>
			<tr>
				<td> Password </td> 
				<td> <input type = "password" name = "password"> </td>
			</tr>
		</table>
			<input type = "submit" value = "LOGIN">
		</form>
		</br></br>
		<a href = "register.php"> New to the game? Click here to register. </a> 
		</center>
	</body>
</html>
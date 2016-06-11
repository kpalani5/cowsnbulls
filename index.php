<?php
	include("config.php");
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql = "SELECT Password FROM login WHERE Username = '$username';";
		$pass = mysqli_query($db,$sql) or die (mysqli_error($db));
		if(hash_equals($pass,crypt($password,$pass)))
		{
			header("home.php");
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
			<input type = "submit" value = "Login">
		</form>
		</br></br>
		<a href = "register.php"> New to the game? Click here to register. </a> 
		</center>
	</body>
</html>
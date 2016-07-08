<?php
	include("config.php");
	include("session.php");
	$login_user = $_SESSION['login_user'];
	$type = $_GET['type'];
	if($type == "saved")
	{
		$sql = "SELECT GameID,GameTime,Status FROM Game WHERE Username = '$login_user' AND Status = 'Open' AND Mode in ('Freestyle','Counter');";
		$val = "CONTINUE GAME";
	}
	else
	{
		$sql = "SELECT GameID,GameTime,Status FROM Game WHERE Username = '$login_user' AND Status IN ('Success','Failure');";
		$val = "VIEW GAME";
	}
	$result = mysqli_query($db,$sql);
		
?>

<html>
	<head>
		<title>Cows N Bulls</title>
	</head>
	<body>
		<center>
		<h1> LIST OF GAMES </h1>
		<br>
		<br>
		<table border = "2">
			<th> Game ID </th>
			<th> Game Start Time </th>
			<th> Game Status </th>
			<th>  </th>
				<?php
					while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						echo "<tr>";
						echo "<form action = 'game.php' method = 'post'>";
						echo "<td>" . $row["GameID"] . "</td>";
						echo "<td>" . $row["GameTime"] . "</td>";
						echo "<td>" . $row["Status"] . "</td>";
						echo "<input type = 'hidden' id = 'game_id' name = 'game_id' value = " . $row["GameID"] . ">";
						echo "<td> <input type = 'submit' value = " . $val . "> </td>";
						echo "</form>";
						echo "</tr>";
					}
				?>
		</table>
		</center>
	</body>
</html>
<?php
	include("config.php");
	include("session.php");
	$login_user = $_SESSION['login_user'];
	$type = $_GET['type'];
	if($type == "saved")
	{
		$sql = "SELECT SequenceID,Score,Letters,Difficulty FROM SequenceList WHERE Username = '$login_user' AND SequenceStatus = 'Open';";	
	}
	else
	{
		$sql = "SELECT SequenceID,Score,Letters,Difficulty FROM SequenceList WHERE Username = '$login_user' AND SequenceStatus = 'Finished';";	
	}
	$result = mysqli_query($db,$sql);
?>

<html>
	<head>
		<title>Cows N Bulls</title>
	</head>
	<body>
		<center>
		<h1> LIST OF SEQUENCES </h1>
		<br>
		<br>
		<table border = "2">
			<th> Sequence ID </th>
			<th> Score </th>
			<th>  </th>
				<?php
					while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						$letter = "Four";
						if($row["Letters"] == 5)
						{
							$letter = "Five";
						}
						echo "<tr>";
						echo "<form action = 'pre_game.php' method = 'post'>";
						echo "<td>" . $row["SequenceID"] . "</td>";
						echo "<td>" . $row["Score"] . "</td>";
						echo "<input type = 'hidden' id = 'seq_id' name = 'seq_id' value = " . $row["SequenceID"] . ">";
						echo "<input type = 'hidden' id = 'level' name = 'level' value = " . $row["Difficulty"] . ">";
						echo "<input type = 'hidden' id = 'letter' name = 'letter' value = " . $letter . ">";
						echo "<input type = 'hidden' id = 'mode' name = 'mode' value = 'Sequence'>";
						if($type == "saved")
						{
							echo "<td> <input type = 'submit' value = 'CONTINUE SEQUENCE'> </td>";
						}
						echo "</form>";
						echo "</tr>";
					}
				?>
		</table>
		</center>		
	</body>
</html>
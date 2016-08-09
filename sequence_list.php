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
		<h2 class = "headtext"> LIST OF SEQUENCES </h2>
  </div>
		<br>
		<br>
    <div class = "row">
      <div class = "col-sm-4"> </div>
      <div class = "col-sm-4">
		<table class = "table table-bordered">
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
						echo "<td class = 'table_txt'>" . $row["SequenceID"] . "</td>";
						echo "<td class = 'table_txt'>" . $row["Score"] . "</td>";
						echo "<input type = 'hidden' id = 'seq_id' name = 'seq_id' value = " . $row["SequenceID"] . ">";
						echo "<input type = 'hidden' id = 'level' name = 'level' value = " . $row["Difficulty"] . ">";
						echo "<input type = 'hidden' id = 'letter' name = 'letter' value = " . $letter . ">";
						echo "<input type = 'hidden' id = 'mode' name = 'mode' value = 'Sequence'>";
						if($type == "saved")
						{
							echo "<td> <input type = 'submit' class = 'btn btn-lg btn-success' value = 'CONTINUE SEQUENCE'> </td>";
						}
						echo "</form>";
						echo "</tr>";
					}
				?>
		</table>
  </div>
  <div class = "col-sm-4"></div>
</div>
		<br>
		<br>
		<form action = "home.php" method = "post">
			<input type = "submit" class = "btn btn-lg btn-success" value = "BACK TO HOMEPAGE" id = "backbutton">
		</form>
		</center>
	</body>
</html>

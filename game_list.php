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
		$sql = "SELECT GameID,GameTime,Status FROM Game WHERE Username = '$login_user' AND Status IN ('Success','Failure') ORDER BY GameTime DESC LIMIT 10;";
		$val = "VIEW GAME";
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

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: auto;
		height: 100%;
    background-color: black;

}

li a {
    display: block;
    color: gold;
		font-weight: bolder;
    padding: 8px 16px;
    text-decoration: none;
		font-family: "Comic Sans MS", cursive, sans-serif;
}

li a:hover {
    background-color: white;
    color: red;
}

</style>
		<title>Cows N Bulls</title>
	</head>
	<body>

		<div class = "jumbotron">
		<h2 class = "headtext"> LIST OF GAMES </h2>
	</div>
		<div class = "row">
			<div class = "col-sm-2">

				<ul>
		  <li><a href="home.php">Home</a></li>
		  <li><a href="#">Forum</a></li>
		  <li><a href="#">Statistics</a></li>
			<li><a href="#">Game Manual</a></li>
		  <li><a href="#">Leaderboard</a></li>
			<li><a href="#">Account Settings</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">About</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
			</div>

			<div class = "col-sm-2"> </div>
			<div class = "col-sm-4">
				<br>
				<br>
				<center>
		<table class = "table table-bordered">
			<th> Game ID </th>
			<th> Game Start Time </th>
			<th> Game Status </th>
			<th>  </th>
				<?php
					while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						echo "<tr>";
						echo "<form action = 'game.php' method = 'post'>";
						echo "<td class = 'table_txt'>" . $row["GameID"] . "</td>";
						echo "<td class = 'table_txt'>" . $row["GameTime"] . "</td>";
						echo "<td class = 'table_txt'>" . $row["Status"] . "</td>";
						echo "<input type = 'hidden' id = 'game_id' name = 'game_id' value = " . $row["GameID"] . ">";
						echo "<input type = 'hidden' name = 'time_left' id = 'time_left' value = ''>";
						echo "<td> <input type = 'submit' class = 'btn btn-lg btn-success' value = " . $val . "> </td>";
						echo "</form>";
						echo "</tr>";
					}
				?>
		</table>
		</center>
	</div>
	<div class = "col-sm-4"> </div>
</div>
		<br>
		<br>

	</body>
</html>

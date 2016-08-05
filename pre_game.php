<?php
	include("config.php");
	include("session.php");
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$login_user = $_SESSION['login_user'];
		$mode = $_POST["mode"];
		$level = $_POST["level"];
		$letter = 4;
		if($_POST["letter"] === "Five")
		{
			$letter = 5;
		}
		$sql = "SELECT count(*) FROM Wordlist WHERE Letters = '$letter' AND Difficulty = '$level';";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

		$random_limit = $row["count(*)"];
		$random_number = rand(1,$random_limit);

		$sql = "SELECT Word FROM Wordlist WHERE Letters = '$letter' AND Difficulty = '$level' AND TypeCount = '$random_number';";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$game_word = $row["Word"];

		$sql = "INSERT INTO Game(Username,Word,Status,GameTime,Mode) VALUES ('$login_user','$game_word','New',now(),'$mode');";
		mysqli_query($db,$sql);

		$sql = "SELECT GameID FROM Game WHERE Username = '$login_user' AND Word = '$game_word' AND Status = 'New';";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$game_id = $row["GameID"];

		$start_val = "START GAME";
		$cancel_val = "CANCEL GAME";
		$prev_game = "";
		if($mode == "Sequence")
		{
			$seq_id = $_POST["seq_id"];
			if($seq_id == "")
			{
				$sql = "INSERT INTO Sequence(GameID,GameCount,GameStatus) VALUES ('$game_id','1','New');";
				mysqli_query($db,$sql);

				$sql = "SELECT SequenceID FROM Sequence WHERE GameID = '$game_id';";
				$result = mysqli_query($db,$sql);
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$seq_id = $row["SequenceID"];

				$sql = "INSERT INTO SequenceList VALUES ('$seq_id','0','$login_user','New','$letter','$level');";
				mysqli_query($db,$sql);

				$start_val = "START SEQUENCE";
			}
			else
			{
				$sql = "SELECT count(*) FROM Sequence WHERE SequenceID = '$seq_id';";
				$result = mysqli_query($db,$sql);
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$seq_count = $row["count(*)"];

				$sql = "SELECT GameID FROM Sequence WHERE SequenceID = '$seq_id' AND GameStatus = 'Complete';";
				$result = mysqli_query($db,$sql);
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$prev_game = $row["GameID"];

				$sql = "UPDATE Sequence SET GameStatus = 'Intermediate' WHERE GameID = '$prev_game';";
				mysqli_query($db,$sql);

				$seq_count++;
				$sql = "INSERT INTO Sequence(SequenceID,GameID,GameCount,GameStatus) VALUES ('$seq_id','$game_id','$seq_count','New');";
				mysqli_query($db,$sql);
				$start_val = "CONTINUE SEQUENCE";
				$cancel_val = "SAVE AND CONTINUE LATER";
			}
		}
	}
	else
	{
		header("Location: home.php");
	}
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
		<div class = "jumbotron">
		<center> <h2 class = "headtext"> Get Ready to Start the Game </h2> </center>
	</div>
		<br>
		<br>
		<form action = "game.php" method = "post">
			<input type = "hidden" name = "mode" value = "<?php echo $mode ?>" >
			<input type = "hidden" name = "game_id" value = "<?php echo $game_id ?>" >
			<input type = "hidden" name = "time_left" value = "<?php echo (time()+24);?>" >
			<center> <input type = "submit" class = "btn btn-success btn-lg" value = "<?php echo $start_val; ?>" > </center>
		</form>
		<br>
		<form action = "cancel_game.php" method = "post">
			<input type = "hidden" name = "game_id" value = "<?php echo $game_id ?>" >
			<input type = "hidden" name = "prev_game" value = "<?php echo $prev_game ?>" >
			<center> <input type = "submit" class = "btn btn-success btn-lg" value = "<?php echo $cancel_val; ?>" > </center>
		</form>
	</body>
</html>

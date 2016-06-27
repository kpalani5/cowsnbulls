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
	}	
?>

<html>
	<head>
		<title>Cows N Bulls</title>
	</head>
	<body>
		<center> <h2> Get Ready to Start the Game </h2> </center>
		<br>
		<form action = "game.php" method = "post">
			<input type = "hidden" name = "mode" value = "<?php echo $mode ?>" >
			<input type = "hidden" name = "game_id" value = "<?php echo $game_id ?>" >
			<center> <input type = "submit" value = "START GAME"> </center>
		</form>
		<br>
		<form action = "cancel_game.php" method = "post">
			<input type = "hidden" name = "game_id" value = "<?php echo $game_id ?>" >
			<center> <input type = "submit" value = "CANCEL GAME"> </center>
		</form>
	</body>
</html>
<?php
	include("config.php");
	include("session.php");
	
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

?>

<html>
	<body>
		<form action = "game.php" method = "post">
			<input type = "hidden" name = "mode" value = "<?php echo $mode ?>" >
			<input type = "hidden" name = "game_word" value = "<?php echo $game_word ?>" >
			<center> <input type = "submit" value = "START GAME"> </center>
		</form>
	</body>
</html>
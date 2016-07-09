<?php
	include("config.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$game_id = $_POST["game_id"];
		$prev_game = $_POST["prev_game"];
		$sql = "DELETE FROM Game WHERE GameID = '$game_id';";
		mysqli_query($db,$sql);
		if($prev_game != "")
		{
			$sql = "UPDATE Sequence SET GameStatus = 'Complete' WHERE GameID = '$prev_game';";
			mysqli_query($db,$sql);	
		}
		header('Location: home.php');
	}
	else
	{
		header("Location: home.php");
	}
	
?>


<?php
	include("config.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$game_id = $_POST["game_id"];
		$sql = "DELETE FROM Game WHERE GameID = '$game_id';";
		mysqli_query($db,$sql);
		header('Location: home.php');
	}
	
?>


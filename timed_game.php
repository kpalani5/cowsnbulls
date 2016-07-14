<?php
	include("config.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$game_id = $_POST["game_id"];
		$mode = $_POST["mode"];
		$sql = "UPDATE Game SET Status = 'Failure' WHERE GameID = '$game_id';";
		mysqli_query($db,$sql);
		if($mode == "Sequence")
		{
			$sql = "SELECT SequenceID FROM Sequence WHERE GameID = '$game_id';";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$seq_id = $row["SequenceID"];
			
			$sql = "UPDATE SequenceList SET SequenceStatus = 'Finished' WHERE SequenceID = '$seq_id';";
			mysqli_query($db,$sql);				
		}
	}
?>


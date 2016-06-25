<?php
	include("config.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$guess = strtoupper($_POST["guess"]);
		$game_id = $_POST["game_id"];
		$turncount = $_POST["turncount"];
		$cows = 0;
		$bulls = 0;
		$sql = "SELECT Word FROM Game WHERE GameID = '$game_id';";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$game_word = $row["Word"];
		$letter = strlen($game_word);
		$sql = "SELECT count(*) FROM Wordlist WHERE Word = '$guess';";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$validity = "Invalid";
		if($row["count(*)"] > 0 && strlen($guess) == $letter)
		{
			$validity = "Valid";
			//Calculate cows and bulls values
			$i = 0;
			for($i = 0; $i < $letter; $i++)
			{
				$char = substr($game_word,$i,1);
				$pos = strpos($guess,$char);
				if($pos === $i)
				{
					$bulls++;
				}
				else if($pos !== FALSE)
				{
						$cows++;
				}
			}
		}
		else
		{
			$cows = -1;
			$bulls = -1;
		}
		$sql = "INSERT INTO Turn(GameID,TurnCount,Guess,Cows,Bulls,Validity) VALUES ('$game_id','$turncount','$guess','$cows','$bulls','$validity');";	
		mysqli_query($db,$sql) or die(mysqli_error($db));
		$val = ($bulls * 10) + $cows;
		echo("$val");
	}	
?>
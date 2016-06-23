<?php
	include("config.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$game_id = $_POST["game_id"];
		$sql = "UPDATE Game SET Status = 'Open' WHERE GameID = '$game_id';";
		mysqli_query($db,$sql);
	}
?>

<html>
	<body>
		<form>
			<table>
				
			</table>
		</form>
	</body>
</html>
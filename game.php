<?php
	include("config.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$game_id = $_POST["game_id"];
		$sql = "SELECT Status,Mode FROM Game WHERE GameID = '$game_id';";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$status = $row["Status"];
		$mode = $row["Mode"];
		if($status == "New")
		{
			$sql = "UPDATE Game SET Status = 'Open' WHERE GameID = '$game_id';";
			mysqli_query($db,$sql);
			$turncount = 1;
		}
		else
		{
			$sql = "SELECT count(*) FROM Turn WHERE GameID = '$game_id';";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$turncount = $row["count(*)"] + 1;
		}
		$save_status_disable = "enabled";
		if($mode == "Timer" || $mode == "Sequence")
		{
			$save_status_disable = "disabled";
		}
		if($status == "Success" || $status == "Failure")
		{
			$save_status_disable = "disabled";
			$guess_status_disable = "disabled";
			$guess_status_readonly = "readonly";
		}
	}

?>

<html>
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
	<head>
		<title>Cows N Bulls</title>
	<script type = "text/javascript">
		function cowsNbulls() {	
			$.ajax(
			{
				url: "cnb.php",
				data: "game_id="+$("#game_id").val()+"&turncount="+$("#turncount").val()+"&guess="+$("#guess").val(),
				type: "POST",
				success:function(data){
					var quo = "X";
					var rem = "X";
					if(data >= 0)
					{						
						var quo = Math.floor(data/10);
						var rem = data % 10;
					}
					if(quo > 10)
					{
						quo = quo % 10;
					}
					var guessval = $("#guess").val();
					$("#game_table").append("<tr> <td>" + guessval + "</td> <td>" + rem + "</td> <td>" + quo + "</td> </tr>");
					$("#guess").val('');
					if(data >= 100 || data < -100)
					{
						$("#guess").prop("readonly",true);
						$("#gbutton").prop("disabled",true);
						$("#sbutton").prop("disabled",true);
					}
				},
				error:function (){}
			}
			);
			$("#turncount").get(0).value++; 
		}
	</script>
	</head>
	<body>
		<center> <h1> COWS AND BULLS </h1> </center>
		<form method = "post">
			<input type = "hidden" name = "game_id" id = "game_id" value = "<?php echo $game_id ?>" <?php echo $guess_status_readonly; ?>>
			<input type = "hidden" name = "turncount" id = "turncount" value = "<?php echo $turncount ?>" >
			<center>
			<table>
				<tr> 	
				<td> <input type = "text" name = "guess" id = "guess" autocomplete = "off" required> </td>
				<td> <input type = "button" value = "GUESS" id = "gbutton" onClick = "cowsNbulls();" <?php echo $guess_status_disable;?>> </td>
				</tr>
			</table>
			</center>
		</form>
		<center>
			<table border = "2" id = "game_table">
				<th> GUESS </th>
				<th> COWS </th>
				<th> BULLS </th>
				<?php
					if($status != "New")
					{
						$sql = "SELECT Guess,Cows,Bulls FROM Turn WHERE GameID = '$game_id'; ORDER BY TurnCount";
						$result = mysqli_query($db,$sql);
						while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
						{
							echo "<tr>";
							echo "<td>" . $row["Guess"] . "</td>";
							if($row["Cows"] < 0)
							{
								echo "<td> X <\td>";
								echo "<td> X <\td>";
							}
							else
							{
								echo "<td>" . $row["Cows"] . "</td>";
								echo "<td>" . $row["Bulls"] . "</td>";
							}
							echo "</tr>";
						}
					}
				?>
				<tr> 	
				</tr>
			</table>
		</center>
		<br>
		<center>
		<form action = "save_game.php" method = "post">
			<input type = "submit" value = "SAVE GAME" id = "sbutton" <?php echo $save_status_disable; ?>> 
		</form>
		</center>
	</body>
</html>
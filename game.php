<?php
	include("config.php");
	include("session.php");
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$game_id = $_POST["game_id"];
		$sql = "SELECT Status,Mode,Word FROM Game WHERE GameID = '$game_id';";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$status = $row["Status"];
		$mode = $row["Mode"];		
		$gword = $row["Word"];
		
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
		$guess_status_disable = "enabled";
		$guess_status_readonly = "";
		$back_button_enable = "disabled";
		if($mode == "Timer" || $mode == "Sequence")
		{
			$save_status_disable = "disabled";
		}
		$seq_id = "";
		$level = "";
		$letter = "Four";
		if($mode == "Sequence")
		{
			$sql = "SELECT Difficulty,Letters FROM Wordlist WHERE Word = '$gword';";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$level = $row["Difficulty"];
			if($row["Letters"] == 5)
			{
				$letter = "Five";
			}
		
			$sql = "SELECT SequenceID FROM Sequence WHERE GameID = '$game_id';";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$seq_id = $row["SequenceID"];
			
			$sql = "UPDATE Sequence SET GameStatus = 'Intermediate' WHERE SequenceID = '$seq_id';";
			mysqli_query($db,$sql);
			
			$sql = "UPDATE Sequence SET GameStatus = 'Complete' WHERE GameID = '$game_id';";
			mysqli_query($db,$sql);
			
			$sql = "SELECT SequenceStatus FROM SequenceList WHERE SequenceID = '$seq_id';";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$seq_stat = $row["SequenceStatus"];
			
			if($seq_stat == "New")
			{
				$sql = "UPDATE SequenceList SET SequenceStatus = 'Open' WHERE SequenceID = '$seq_id';";
				mysqli_query($db,$sql);
			}
				
		}
		if($status == "Success" || $status == "Failure")
		{
			$save_status_disable = "disabled";
			$guess_status_disable = "disabled";
			$guess_status_readonly = "readonly";
			$back_button_enable = "enabled";
		}
	}
	else
	{
		header("Location: home.php");
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
					var turnc = $('#turncount').get(0).value - 1;
					$("#game_table").append("<tr> <td>" + turnc + "</td> <td>" + guessval + "</td> <td>" + rem + "</td> <td>" + quo + "</td> </tr>");
					$("#guess").val('');
					$("#backbutton").prop("disabled",true);
					if(data >= 100 || data < -100)
					{
						$("#guess").prop("readonly",true);
						$("#gbutton").prop("disabled",true);
						$("#sbutton").prop("disabled",true);
						$("#backbutton").prop("disabled",false);
					}
					var mode = $("#mode").val();
					if(mode == "Sequence" && data >= 100)
					{
							$("#ssbutton").prop("disabled",false);
							$("#scbutton").prop("disabled",false);
					}
				},
				error:function (){}
			}
			);
			$("#turncount").get(0).value++; 
		}
		
		function sub(e)
		{
			 e = e || window.event;
			if (e.keyCode == 13)
			{
				document.getElementById('gbutton').click();
				return false;
			}
			return true;	
		}
	</script>
	</head>
	<body bgcolor = "cyan">
		<center> <h1> COWS AND BULLS </h1> </center>
		<div id = 'timer'> </div>
		<br>
		<br>
		<form method = "post">
			<input type = "hidden" name = "game_id" id = "game_id" value = "<?php echo $game_id ?>" <?php echo $guess_status_readonly; ?>>
			<input type = "hidden" name = "turncount" id = "turncount" value = "<?php echo $turncount ?>" >
			<input type = "hidden" name = "mode" id = "mode" value = "<?php echo $mode ?>" >
			<input type = "hidden" name = "status" id = "status" value = "<?php echo $status ?>" >
			<center>
			<table>
				<tr>
				<td> <input type = "text" name = "guess" id = "guess" autocomplete = "off" required onkeypress = "return sub(event);" </td>
				<td> <input type = "button" value = "GUESS" id = "gbutton" onClick = "cowsNbulls();" <?php echo $guess_status_disable;?>> </td>
				</tr>
			</table>
			</center>
		</form>
		<center>
			<table border = "2" id = "game_table">
				<th> TURN </th>
				<th> GUESS </th>
				<th> COWS </th>
				<th> BULLS </th>
				<?php
					if($status != "New")
					{
						$sql = "SELECT Guess,Cows,Bulls,TurnCount FROM Turn WHERE GameID = '$game_id' ORDER BY TurnCount;";
						$result = mysqli_query($db,$sql);
						if($result)
						{
							while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
							{
								echo "<tr>";
								echo "<td>" . $row["TurnCount"] . "</td>";
								echo "<td>" . $row["Guess"] . "</td>";
								if($row["Cows"] < 0)
								{
									echo "<td> X </td>";
									echo "<td> X </td>";
								}
								else
								{
									echo "<td>" . $row["Cows"] . "</td>";
									echo "<td>" . $row["Bulls"] . "</td>";
								}
								echo "</tr>";
							}
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
		<form action = "save_game.php" method = "post">
			<input type = "hidden" name = "game_id" value = <?php echo $game_id ?>>
			<input type = "submit" value = "SAVE SEQUENCE" id = "ssbutton" disabled> 
		</form>
		<form action = "pre_game.php" method = "post">
			<input type = "hidden" name = "mode" id = "mode" value = "<?php echo $mode ?>" >
			<input type = "hidden" name = "letter" id = "letter" value = "<?php echo $letter ?>" >
			<input type = "hidden" name = "level" id = "level" value = "<?php echo $level ?>" >
			<input type = "hidden" name = "seq_id" value = <?php echo $seq_id ?>>
			<input type = "submit" value = "CONTINUE SEQUENCE" id = "scbutton" disabled> 
		</form>
		<form action = "home.php" method = "post">
			<input type = "submit" value = "BACK TO HOMEPAGE" id = "backbutton" <?php echo $back_button_enable; ?>>
		</form>
		</center>
	</body>
</html>
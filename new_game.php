<?php
	
?>

<html>
	<head>
		<title>Cows N Bulls</title>
	</head>
	<body>
		<center> <h2> Game Selection </h2> </center>
		<br>
		<center>
		<form action = "pre_game.php" method = "post">
			<table>
				<tr> 
				<td> LEVEL: </td>
				<td>
				<select name = "level">
					<option value = "Easy"> Easy </option>
					<option value = "Hard"> Hard </option>
				</select>
				</td>
				</tr>
				<tr> <td> </td> </tr>
				<tr> <td> </td> </tr>
				<tr>
				<td> MODE: </td>
				<td> 
				<select name = "mode">
					<option value = "Freestyle"> Freestyle </option>
					<option value = "Counter"> Counter </option>
					<option value = "Timer"> Timer </option>
					<option value = "Sequence"> Sequence </option>
				</select>
				</td>
				</tr>
				<tr> <td> </td> </tr>
				<tr> <td> </td> </tr>
				<tr>
				<td> LETTER COUNT: </td>
				<td>
				<select name = "letter">
					<option value = "Four"> Four </option>
					<option value = "Five"> Five </option>
				</select>
				</td>
				</tr>
			</table>
			<br>
			<input type = "hidden" value = "" name = "seq_id">
			<input type = "submit" value = "PLAY">
		</form>
		</center>
	</body>
</html>
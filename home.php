<?php
	include("session.php");
?>
<html>
	<style>
		a.button 
		{
			-webkit-appearance: button;
			-moz-appearance: button;
			appearance: button;
			width: 300;
			height: 60;
			border-radius:10px;
			-webkit-border-radius:10px;
			box-shadow:0 1px 2px #5e5d5b;
			text-decoration: none;
			text-align: center;
			
		}
	</style>
	<head>
		<title>Cows N Bulls</title>
	</head>
	<body bgcolor = "#00FF00">
		<center> <h2> Welcome <?php echo $login_session; ?> </h2> </center>
		<br>
		<br>
		<br>
		<center>
			<table>
			<tr>
			<td> <h3> <a class = "button" href = "new_game.php"> NEW GAME </a> </h3> </td>
			
			<td> <h3> <a class = "button" href = "game_list.php?type=saved"> CONTINUE SAVED GAME </a> </h3> </td>
			</tr>
			<tr> <td> <br> <br> </td> </tr>
			<tr>
			<td> <h3> <a class = "button" href = "sequence_list.php?type=saved"> CONTINUE SAVED SEQUENCE </a> </h3> </td>
			
			<td> <h3> <a class = "button" href = "game_list.php?type=finished"> RECENTLY FINISHED GAMES </a> </h3> </td>
			</tr>
			<tr> <td> <br> <br> </td> </tr>
			<tr>
			<td> <h3> <a class = "button" href = "sequence_list.php?type=finished"> RECENTLY FINISHED SEQUENCES </a> </h3> </td>

			<td> <h3> <a class = "button" href = "logout.php"> LOGOUT </a> </h3> </td>
			</tr>
			</table>
		</center>
	</body>
</html>
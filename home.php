<?php
	include("session.php");
?>
<html>
	<head>
		<title>Cows N Bulls</title>
	</head>
	<body>
		<center> <h2> Welcome <?php echo $login_session; ?> </h2> </center>
		<br>
		<center>
			<h3> <a href = "new_game.php"> NEW GAME </a> </h3>
			<h3> <a href = "game_list.php?type=saved"> CONTINUE SAVED GAME </a> </h3>
			<h3> <a href = "sequence_list.php?type=saved"> CONTINUE SAVED SEQUENCE </a> </h3>
			<h3> <a href = "game_list.php?type=finished"> RECENTLY FINISHED GAMES </a> </h3>
			<h3> <a href = "sequence_list.php?type=finished"> RECENTLY FINISHED SEQUENCES </a> </h3>
		</center>
	</body>
</html>
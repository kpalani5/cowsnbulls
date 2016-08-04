<?php
	include("session.php");
?>
<html>
	<head>
			<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			<style>
				body
				{
					background: url('backg.jpg');
				}
				.jumbotron
				{
    			background-color:black;
    			text-align:center;
				}
				.headtext
				{
					color: gold;
					font-style: oblique;
					font-weight: bold;
					font-family: "Comic Sans MS", cursive, sans-serif;	
				}
			</style>
		<title>Cows N Bulls</title>
	</head>
	<body>
		<div class = "jumbotron">
		<center> <h2 class = "headtext"> Welcome <?php echo $login_session; ?> </h2> </center>
	</div>
		<br>
		<center>
			<h3> <a class="btn btn-success btn-lg"  href = "new_game.php"> NEW GAME </a> </h3>
		 <h3> <a class="btn btn-success btn-lg" href = "game_list.php?type=saved"> CONTINUE SAVED GAME </a> </h3>
			<h3> <a class="btn btn-success btn-lg" href = "sequence_list.php?type=saved"> CONTINUE SAVED SEQUENCE </a> </h3>
		 <h3> <a class="btn btn-success btn-lg" href = "game_list.php?type=finished"> RECENTLY FINISHED GAMES </a> </h3>
			<h3> <a class="btn btn-success btn-lg" href = "sequence_list.php?type=finished"> RECENTLY FINISHED SEQUENCES </a> </h3>
		 <h3> <a class="btn btn-success btn-lg" href = "logout.php"> LOGOUT </a> </h3>
		</center>
	</body>
</html>

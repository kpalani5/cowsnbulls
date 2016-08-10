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

				ul {
				    list-style-type: none;
				    margin: 0;
				    padding: 0;
				    width: auto;
						height: 100%;
				    background-color: black;

				}

				li a {
				    display: block;
				    color: gold;
						font-weight: bolder;
				    padding: 8px 16px;
				    text-decoration: none;
						font-family: "Comic Sans MS", cursive, sans-serif;
				}

				li a:hover {
				    background-color: white;
				    color: red;
				}

			</style>
		<title>Cows N Bulls</title>
	</head>
	<body>
		<div class = "jumbotron">
		<center> <h2 class = "headtext"> Welcome <?php echo $login_session; ?> </h2> </center>
	</div>
	<div class = "row">
	<div class = "col-sm-2">

		<ul>
	<li><a href="home.php">Home</a></li>
	<li><a href="#">Forum</a></li>
	<li><a href="#">Statistics</a></li>
	<li><a href="#">Game Manual</a></li>
	<li><a href="#">Leaderboard</a></li>
	<li><a href="#">Account Settings</a></li>
	<li><a href="#">Contact</a></li>
	<li><a href="#">About</a></li>
	<li><a href="logout.php">Logout</a></li>
</ul>
	</div>
	<div class = "col-sm-2"> </div>
	<div class = "col-sm-4">
		<br>
		<center>
			<h3> <a class="btn btn-success btn-lg"  href = "new_game.php"> NEW GAME </a> </h3>
		 <h3> <a class="btn btn-success btn-lg" href = "game_list.php?type=saved"> CONTINUE SAVED GAME </a> </h3>
			<h3> <a class="btn btn-success btn-lg" href = "sequence_list.php?type=saved"> CONTINUE SAVED SEQUENCE </a> </h3>
		 <h3> <a class="btn btn-success btn-lg" href = "game_list.php?type=finished"> RECENTLY FINISHED GAMES </a> </h3>
			<h3> <a class="btn btn-success btn-lg" href = "sequence_list.php?type=finished"> RECENTLY FINISHED SEQUENCES </a> </h3>
		</center>
	</div>
	<div class = "col-sm-4"> </div>
</div>
	</body>
</html>

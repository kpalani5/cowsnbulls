<?php
	include("session.php");
  include("config.php");
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

        .table
        {
        	border-color: red;
        }

        .table_txt
        {
        	color: red;
        	font-style: oblique;
        	font-weight: bold;
        	font-family: "Comic Sans MS", cursive, sans-serif;
        }

			</style>
		<title>Cows N Bulls</title>
	</head>
	<body>
		<div class = "jumbotron">
		<center> <h2 class = "headtext"> STATISTICS </h2> </center>
	</div>
	<div class = "row">
	<div class = "col-sm-2">
	<ul>
	<li><a href="home.php">Home</a></li>
	<li><a href="stats.php">Statistics</a></li>
	<li><a href="manual.php">Game Manual</a></li>
	<li><a href="leaderboard.php">Leaderboard</a></li>
	<li><a href="account_settings.php">Account Settings</a></li>
	<li><a href="contact.php">Contact</a></li>
	<li><a href="about.php">About</a></li>
	<li><a href="logout.php">Logout</a></li>
</ul>
	</div>
	<div class = "col-sm-2"> </div>
	<div class = "col-sm-4">
  <p class = "table_txt">
    <center class = "table_txt"> BEST SEQUENCE SCORE :
    <?php
      $login_user = $_SESSION['login_user'];
      $sql = "SELECT max(Score) FROM SequenceList WHERE Username = '$login_user';";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $best = $row["max(Score)"];
      echo "$best";
    ?>
  </center>
  </p>
<br>
<table class = "table table-bordered">
  <tr>
  <th class = "table_txt"> MODE </th>
  <th class = "table_txt"> LETTERS </th>
  <th class = "table_txt"> DIFFICULTY </th>
  <th class = "table_txt"> GAMES PLAYED </th>
  <th class = "table_txt"> GAMES WON </th>
  </tr>
  <?php
      $login_user = $_SESSION['login_user'];
      function stats_values($mode,$letter,$difficulty)
      {
        include('config.php');
        $login_user = $_SESSION["login_user"];
        $sql = "SELECT count(*) FROM Game G JOIN Wordlist W WHERE G.Username = '$login_user' AND G.Mode = '$mode' AND W.Letters = '$letter' AND W.Difficulty = '$difficulty' AND G.Word = W.Word;";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $played = $row["count(*)"];

        $sql = "SELECT count(*) FROM Game G JOIN Wordlist W WHERE G.Username = '$login_user' AND G.Mode = '$mode' AND W.Letters = '$letter' AND W.Difficulty = '$difficulty' AND G.Word = W.Word AND G.Status = 'Success';";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $won = $row["count(*)"];

        echo "<tr>";
        echo "<td class = 'table_txt'> $mode </td>";
        echo "<td class = 'table_txt'> $letter </td>";
        echo "<td class = 'table_txt'> $difficulty </td>";
        echo "<td class = 'table_txt'> $played </td>";
        echo "<td class = 'table_txt'> $won </td>";
        echo "</tr>";
      }
      stats_values('Freestyle',4,'Easy');
      stats_values('Freestyle',4,'Hard');
      stats_values('Freestyle',5,'Easy');
      stats_values('Freestyle',5,'Hard');
      stats_values('Counter',4,'Easy');
      stats_values('Counter',4,'Hard');
      stats_values('Counter',5,'Easy');
      stats_values('Counter',5,'Hard');
      stats_values('Timer',4,'Easy');
      stats_values('Timer',4,'Hard');
      stats_values('Timer',5,'Easy');
      stats_values('Timer',5,'Hard');
      stats_values('Sequence',4,'Easy');
      stats_values('Sequence',4,'Hard');
      stats_values('Sequence',5,'Easy');
      stats_values('Sequence',5,'Hard');
   ?>
</table>

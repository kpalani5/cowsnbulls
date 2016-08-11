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
		<center> <h2 class = "headtext"> CONTACT </h2> </center>
	</div>
  <div class = "row">
  <div class = "col-sm-2">
    <ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="#">Forum</a></li>
  <li><a href="#">Statistics</a></li>
  <li><a href="#">Game Manual</a></li>
  <li><a href="#">Leaderboard</a></li>
  <li><a href="account_settings.php">Account Settings</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="logout.php">Logout</a></li>
  </ul>
  </div>
  <div class = "col-sm-2"> </div>
  <div class = "col-sm-4">
    <br>
    <br>
    <center>
      <h3>
    For queries and suggestions email cnb.the.game@gmail.com.
    <br>
    <br>
    We will get back to you within two days.
    <br>
    <br>
    Hope you enjoyed playing!
    <br>
    <br>
    THANK YOU!
  </h3>
  </center>
  </div>
<div class = "col-sm-4"> </div>
</div>
</body>
</html>

<?php
	include("session.php");
?>
<html>
	<body>
		<center> <h2> Welcome <?php echo $login_session; ?> </h2> </center>
		<br>
		<center> <h3> <a href = "logout.php"> LOGOUT </a> </h3> </center>
	</body>
</html>
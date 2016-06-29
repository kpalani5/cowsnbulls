<?php
	include("config.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$game_id = $_POST["game_id"];
		$sql = "UPDATE Game SET Status = 'Open' WHERE GameID = '$game_id';";
		mysqli_query($db,$sql);
		$turncount = 1;
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
					alert(data);
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
			<input type = "hidden" name = "game_id" id = "game_id" value = "<?php echo $game_id ?>" >
			<input type = "hidden" name = "turncount" id = "turncount" value = "1" >
			<center>
			<table>
				<tr> 	
				<td> <input type = "text" name = "guess" id = "guess" autocomplete = "off" required> </td>
				<td> <input type = "button" value = "GUESS" id = "gbutton" onClick = "cowsNbulls();"> </td>
				</tr>
			</table>
			</center>
		</form>
		<center>
			<table border = "2" id = "game_table">
				<th> GUESS </th>
				<th> COWS </th>
				<th> BULLS </th>
				<tr> 	
				</tr>
			</table>
		</center>
	</body>
</html>
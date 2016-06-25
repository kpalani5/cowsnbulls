<?php
	//Maintain turncount
	//Send turncount, game_id, game_word and guess to cnb.php
	include("config.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$game_id = $_POST["game_id"];
		$sql = "UPDATE Game SET Status = 'Open' WHERE GameID = '$game_id';";
		mysqli_query($db,$sql);
		$turncount = 0;
	}

?>

<html>
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
	<head>
	<script type = "text/javascript">
		function cowsNbulls() {	
			$.ajax(
			{
				url: "cnb.php",
				data: "game_id="+$("#game_id").val()+"&turncount="+$("#turncount").val()+"&guess="+$("#guess").val(),
				type: "POST",
				success:function(data){
					if(data >= 0)
					{						
						var quo = Math.floor(data/10);
						var rem = data % 10;
						$("#bull").html(quo);
						$("#cow").html(rem);
					}
					else
					{
						$("#bull").html("X");
						$("#cow").html("X");
					}
				},
				error:function (){}
			}
			);
			$("#turncount").get(0).value++; 
			//Make previous text box uneditable and button unclickable
			//Create new text, button and labels with unique id names
			
		}
	</script>
	</head>
	<body>
		<form action = "javascript:cowsNbulls();" method = "post">
			<input type = "hidden" name = "game_id" id = "game_id" value = "<?php echo $game_id ?>" >
			<input type = "hidden" name = "turncount" id = "turncount" value = "0" >
			<table>
				<tr> 	
				<td> <input type = "text" name = "guess" id = "guess"> </td>
				<td> <p id = "cow"> </p> </td>
				<td> <p id = "bull"> </p> </td>
				<td> <input type = "submit" value = "GUESS"> </td>
				</tr>
			</table>
		</form>
	</body>
</html>
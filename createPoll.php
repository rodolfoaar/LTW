<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<script>
			var i = 1;

			function addChoiceF()
			{
				i++;
				var div = document.createElement('div');
				var text = 'Insert choice:<br>';
				var inputText = '<input type="text" name="pollChoice_'+i+'" required="required">';
				var inputButtonAdd = '<input type="button" id="addChoice()" onClick="addChoiceF()" value="+">';
				var inputButtonRemove = '<input type="button" onClick="removeChoiceF(this)" value="-">';
				div.innerHTML = text+inputText+inputButtonAdd+inputButtonRemove;
				document.getElementById('choice').appendChild(div);

				if(i >= 2)
					$("#submitPoll").show();
			}

			function removeChoiceF(div)
			{
				document.getElementById('choice').removeChild(div.parentNode);
				i--;

				if(i < 2)
					$("#submitPoll").hide();
			}
		</script>

	</head>
	<body>
		<form action="insertPoll.php" method="POST">
			<fieldset>
				<legend>Poll</legend>
				Insert title:<br>
				<input type="text" name="pollTitle" required="required"> <br>
				Insert question:<br>
				<input type="text" name="pollQuestion" required="required"> <br>
				<div id="choice">
					Insert choice:<br>
					<input type="text" name="pollChoice_1" required="required">
					<input type="button" id="addChoice()" onClick="addChoiceF()" value="+">
				</div>
			</fieldset> 
			<input type="submit" id="submitPoll" value="Submit poll" hidden="hidden">
		</form>
	</body>
</html>
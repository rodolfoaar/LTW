<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<script>
			var choices = 1;
			//var choicesInput = new Object();

			function insertQuestion()
			{
				var text = "<br> question:";
				var field = "<br> <input type='text' name='question' >";
				$("body #question").append(text, field);
				$("#inserQuestion").hide();
				$("#insertChoice").show();
			}

			function insertChoise()
			{
				var text = "<br> choise:";
				var field = "<br> <input type='text' name='choice"+choices+"'>";
				//var field = "<br> <input type='text' name='choice'>";
				$("body #question").after(text, field);
				choices++;

				if(choices > 2)
				{
					$("#submitPoll").show();
				}
			}

			function submitQuestion()
			{
				var numberOfOptions = choices - 1;
				var optionNumber, option;

				console.log($("input:text[name=pollTitle]").val());
				console.log($("input:text[name=question]").val());

				for(var i=1; i<=numberOfOptions; i++)
				{
					optionNumber = "input:text[name=choice"+i+"]";
					option = $(optionNumber).val();
					console.log(option);
				}
			}
		</script>

	</head>
	<body>
		<fieldset>
			<legend>Poll</legend>
			Insert poll title:<br>
			<input type='text' name='pollTitle' required="required"> <br>
			<section id="question">
			</section>
		</fieldset> 
		<button id="inserQuestion" onclick="insertQuestion()">Insert question</button>
		<button id="insertChoice" onclick="insertChoise()" hidden="hidden">Insert choise</button>
		<button id="submitPoll" onclick="submitQuestion()" hidden="hidden">Submit poll</button> 
	</body>
</html>

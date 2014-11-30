<html>
	<head>
		<script>
			var NUMBER_OF_POLLS_TO_DISPLAY = 5;
			var index = -1;

			function morePolls()
			{
				index++;

				var hr = new XMLHttpRequest();
				var url = "showPollsAjaxPHP.php";
				var polls = "numberOfPolls="+NUMBER_OF_POLLS_TO_DISPLAY+"&index="+index;
				hr.open("POST", url, true);
				hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				hr.onreadystatechange = function()
					{
						if (hr.readyState==4 && hr.status==200)
						{
							var returnData = hr.responseText;

							if(returnData != "error!")
								document.getElementById("pollsTitles").innerHTML = returnData;
							else
								index--;
						}
					}
				hr.send(polls);
			}

			function lessPolls()
			{
				index--;

				var hr = new XMLHttpRequest();
				var url = "showPollsAjaxPHP.php";
				var polls = "numberOfPolls="+NUMBER_OF_POLLS_TO_DISPLAY+"&index="+index;
				hr.open("POST", url, true);
				hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				hr.onreadystatechange = function()
					{
						if (hr.readyState==4 && hr.status==200)
						{
							var returnData = hr.responseText;

							if(returnData != "error!")
								document.getElementById("pollsTitles").innerHTML = returnData;
							else
								index++;
						}
					}
				hr.send(polls);
			}

		</script>
	</head>
	<body>
		<div id="polls">
			<h1> Polls </h1>
			<div id="pollsTitles"></div><br>
		</div>
		<div id="waiting"></div><br>
		<input type="button" id="showPolls" onClick="morePolls()" value="[+]">
		<input type="button" id="showPolls" onClick="lessPolls()" value="[-]">
	</body>
</html>
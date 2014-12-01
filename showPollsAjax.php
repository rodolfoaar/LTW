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
							{
								clearData();

								var pollsT = JSON.parse(this.responseText);

								for (p in pollsT)
								{
									var option = document.createElement("P");
									option.innerHTML = pollsT[p]['title'];
									document.getElementById("allPolls").appendChild(option);
								}

							}
								
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
							{
								clearData();

								var pollsT = JSON.parse(this.responseText);

								for (p in pollsT)
								{
									var option = document.createElement("P");
									option.innerHTML = pollsT[p]['title'];
									document.getElementById("allPolls").appendChild(option);
								}
							}
								
							else
								index++;
						}
					}
				hr.send(polls);
			}

			function clearData()
			{
				var myNode = document.getElementById("allPolls");

				while (myNode.firstChild)
				{
					myNode.removeChild(myNode.firstChild);
				}
			}

			function clearDataLast()
			{
				var myNode = document.getElementById("lastPollsInserted");

				while (myNode.firstChild)
				{
					myNode.removeChild(myNode.firstChild);
				}
			}

			function clearSearch()
			{
				var myNode = document.getElementById("pollsFound");

				while (myNode.firstChild)
				{
					myNode.removeChild(myNode.firstChild);
				}
			}

			function lastPolls()
			{
				var hr = new XMLHttpRequest();
				var url = "showLastPollsAjaxPHP.php";
				var polls = "numberOfPolls="+NUMBER_OF_POLLS_TO_DISPLAY;
				hr.open("POST", url, true);
				hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				hr.onreadystatechange = function()
					{
						if (hr.readyState==4 && hr.status==200)
						{
							var returnData = hr.responseText;

							clearDataLast();
							var pollsT = JSON.parse(this.responseText);
							for (p in pollsT)
							{
								var option = document.createElement("P");
								option.innerHTML = pollsT[p]['title'];
								document.getElementById("lastPollsInserted").appendChild(option);
							}
						}
					}

				hr.send(polls);
			}

			function searchPolls()
			{
				var wordToSearchFor = document.getElementById("wordToSearchFor").value;
				console.log("word to search for = "+wordToSearchFor);

				///////////////////////////////////////////////////////////////////////
				// function to remove spaces ... just a word you should consider ... //
				///////////////////////////////////////////////////////////////////////

				//if(wordToSearchFor SIZE OF > 0)...

				var hr = new XMLHttpRequest();
				var url = "showSearchedPollsAjaxPHP.php";
				var polls = "wordToSearchFor="+wordToSearchFor;
				hr.open("POST", url, true);
				hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				hr.onreadystatechange = function()
					{
						if (hr.readyState==4 && hr.status==200)
						{
							var returnData = hr.responseText;

							clearSearch();
							var pollsT = JSON.parse(this.responseText);
							for (p in pollsT)
							{
								var option = document.createElement("P");
								option.innerHTML = pollsT[p]['title'];
								document.getElementById("pollsFound").appendChild(option);
								console.log(pollsT);
							}
						}
					}

				hr.send(polls);
			}

		</script>
	</head>
	<body>
		<div id="lastPolls">
			<h1> Last Polls inserted: </h1>
			<div id="lastPollsInserted"></div><br>
		</div>
		<input type="button" id="showPolls" onClick="lastPolls()" value="[Last polls created]">
		
		<div id="polls">
			<h1> Polls: </h1>
			<div id="allPolls"></div><br>
		</div>
		<input type="button" id="" onClick="morePolls()" value="[+]">
		<input type="button" id="" onClick="lessPolls()" value="[-]">
		
		<div id="searchPoll">
			<h1> Search poll: </h1>
			 <input id="wordToSearchFor" type="text" name="word" required="required">
			<div id="pollsFound"></div><br>
		</div>
		<input type="button" id="" onClick="searchPolls()" value="[search]">
	</body>
</html>
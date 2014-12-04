var index = -1;

function clearData()
{
    var myNode = document.getElementById("allPolls");

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

                /*for (p in pollsT)
                {
                    var option = document.createElement("P");
                    option.innerHTML = pollsT[p]['title'];
                    document.getElementById("allPolls").appendChild(option);
                }*/

	            var br = document.createElement("br");

	            for (p in pollsT)
	            {
	                var idPoll = pollsT[p]['idPoll'];
	                var titlePoll = pollsT[p]['title'];
	                var a = document.createElement('a');
	                var linkText = document.createTextNode(titlePoll);
	                a.appendChild(linkText);
	                a.title = titlePoll;
	                a.href = "answerPoll.php?id="+idPoll;

                    var h = document.createElement('h2');
                    h.appendChild(a);

	                document.getElementById("allPolls").appendChild(h);
	                //document.getElementById("allPolls").appendChild(br);

	                var aux = "answerPoll.php?id="+idPoll;
	                console.log(aux);
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

                /*for (p in pollsT)
                {
                    var option = document.createElement("P");
                    option.innerHTML = pollsT[p]['title'];
                    document.getElementById("allPolls").appendChild(option);
                }*/

                var br = document.createElement("br");

	            for (p in pollsT)
	            {
	                var idPoll = pollsT[p]['idPoll'];
	                var titlePoll = pollsT[p]['title'];
	                var a = document.createElement('a');
	                var linkText = document.createTextNode(titlePoll);
	                a.appendChild(linkText);
	                a.title = titlePoll;
	                a.href = "answerPoll.php?id="+idPoll;

                    var h = document.createElement('h2');
                    h.appendChild(a);

	                document.getElementById("allPolls").appendChild(h);
	                //document.getElementById("allPolls").appendChild(br);

	                var aux = "answerPoll.php?id="+idPoll;
	                console.log(aux);
	            }
            }
            else
                index++;
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
            /*for (p in pollsT)
            {
                var option = document.createElement("P");
                option.innerHTML = pollsT[p]['title'];
                document.getElementById("pollsFound").appendChild(option);
                console.log(pollsT);
            }*/

            var br = document.createElement("br");

            for (p in pollsT)
            {
                var idPoll = pollsT[p]['idPoll'];
                var titlePoll = pollsT[p]['title'];
                var a = document.createElement('a');
                var linkText = document.createTextNode(titlePoll);
                a.appendChild(linkText);
                a.title = titlePoll;
                a.href = "answerPoll.php?id="+idPoll;

                var h = document.createElement('h2');
                h.appendChild(a);

                document.getElementById("pollsFound").appendChild(h);
                //document.getElementById("pollsFound").appendChild(br);

                var aux = "answerPoll.php?id="+idPoll;
                console.log(aux);
            }
        }
    }
    hr.send(polls);
}
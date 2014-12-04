var NUMBER_OF_POLLS_TO_DISPLAY = 5;

onload=function()
{
    lastPolls();
    setInterval(lastPolls,3000);
}

function clearDataLast()
{
    var myNode = document.getElementById("lastPollsInserted");

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
            /*for (p in pollsT)
            {
                var option = document.createElement("P");
                option.innerHTML = pollsT[p]['title'];
                document.getElementById("lastPollsInserted").appendChild(option);
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

                document.getElementById("lastPollsInserted").appendChild(h);
                //document.getElementById("lastPollsInserted").appendChild(br);

                var aux = "answerPoll.php?id="+idPoll;
                console.log(aux);
            }
        }
    }

    hr.send(polls);
}
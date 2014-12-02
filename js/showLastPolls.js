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



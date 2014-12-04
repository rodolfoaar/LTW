
//============================================================

function showShareForm()
{
    $("#share").show();
}

//============================================================

function sendMailtoShare()
{
    var name = document.getElementById("username").value;
    var to = document.getElementById("destinationMail").value;
    var pollLink = window.location.href;

    console.log(name);
    console.log(to);
    console.log(pollLink);

    var hr = new XMLHttpRequest();
    var url = "send_mail_share.php";
    var mailInfo = "name="+name+"&to="+to+"&pollLink="+pollLink;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

    hr.onreadystatechange = function()
    {
        if (hr.readyState==4 && hr.status==200)
        {
            var returnData = hr.responseText;
            var p = document.createElement("P");
            p.innerHTML = returnData;
            document.getElementById("emailStatus").appendChild(p);
            console.log(returnData);
        }
    }

    hr.send(mailInfo);
    $("#share").hide();
}
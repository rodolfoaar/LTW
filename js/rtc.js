// Call realTimeClock after document loads
$(realTimeClock);

//============================================================

function realTimeClock() {
			
	var weekday = new Array(7);
	weekday[0]=  "Sunday";
	weekday[1] = "Monday";
	weekday[2] = "Tuesday";
	weekday[3] = "Wednesday";
	weekday[4] = "Thursday";
	weekday[5] = "Friday";
	weekday[6] = "Saturday";
	
	var month = new Array();
	month[0] = "January";
	month[1] = "February";
	month[2] = "March";
	month[3] = "April";
	month[4] = "May";
	month[5] = "June";
	month[6] = "July";
	month[7] = "August";
	month[8] = "September";
	month[9] = "October";
	month[10] = "November";
	month[11] = "December";
	
	var today = new Date();
	
	var weekday = weekday[today.getDay()];
	var day = today.getDate();
	var month = month[today.getMonth()];
	var year = today.getFullYear();
	var hours = today.getHours();
	var minutes = today.getMinutes();
	var seconds = today.getSeconds();
	
	day = addZero(day);
	hours = addZero(hours);
	minutes = addZero(minutes);
	seconds = addZero(seconds);
	
	document.getElementById('timeClock').innerHTML = weekday+" "+day+" "+month+" "+year+" - "+hours+":"+minutes+":"+seconds;
	var t = setTimeout(function(){realTimeClock()},500);
}

//============================================================

function addZero(i) {
	if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
	return i;
}
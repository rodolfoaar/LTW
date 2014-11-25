<?php

	if((isset($_POST['pollTitle'])) && ($_POST['pollTitle'] != " "))
		$pollTitle = $_POST['pollTitle'];

	if((isset($_POST['pollQuestion'])) && ($_POST['pollQuestion'] != " "))
		$pollQuestion = $_POST['pollQuestion'];
	
	$list = "";
	

	$MAX_NUMBER_OF_CHOICES = $_POST['MAX_NUMBER_OF_CHOICES'];

	for($i = 1; $i < $MAX_NUMBER_OF_CHOICES; $i++)
	{
		if((isset($_POST['pollChoice_'.$i])) && (trim($_POST['pollChoice_'.$i]) != ""))
		{
			$list .= $_POST['pollChoice_'.$i];
			$list .= "<br>";
		}
	}

	echo $pollTitle;
	echo "<br>";
	echo $pollQuestion;
	echo "<br>";
	echo $list;
?>
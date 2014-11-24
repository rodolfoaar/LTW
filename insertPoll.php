<?php

	if((isset($_POST['pollTitle'])) && ($_POST['pollTitle'] != " "))
		$pollTitle = $_POST['pollTitle'];

	if((isset($_POST['pollQuestion'])) && ($_POST['pollQuestion'] != " "))
		$pollQuestion = $_POST['pollQuestion'];
	
	$list = "";
	$i = 1;
	$more = TRUE;

	while($more)
	{
		if((isset($_POST['pollChoice_'.$i])) && ($_POST['pollChoice_'.$i] != " "))
		{
			$list .= $_POST['pollChoice_'.$i];
			$list .= "<br>";
		}
		else
			$more = FALSE;

		$i++;
	}

	echo $pollTitle;
	echo "<br>";
	echo $pollQuestion;
	echo "<br>";
	echo $list;
?>
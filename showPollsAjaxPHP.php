<?php
	///////////////////////////
	//connection to data base//
	///////////////////////////
	try
	{
		$dbh = new PDO('sqlite:polls.db');
		$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
		die($e->getMessage());
	}

	/////////////////
	//get all polls//
	/////////////////
	try
	{
		$stmtPoll= $dbh->prepare('SELECT * FROM polls');
		$stmtPoll->execute();
		$resultPoll = $stmtPoll->fetchALL();
	}
	catch (PDOException $e)
	{
		die($e->getMessage());
	}

	//////////////
	//sort polls//
	//////////////
	$pollsTitlesArray = array();
	$i = 0;

	foreach ($resultPoll as $poll)
	{
		$pollsTitlesArray[$i] = $poll['title'];
		$i++;
	}

	$numberOfPollsInDataBase = sizeof($pollsTitlesArray);

	sort($pollsTitlesArray);

	///////////
	//request//
	///////////
	$numberOfPollsRequested = $_POST['numberOfPolls'];
	$indexRequested = $_POST['index'];

	if (isset(array_chunk($pollsTitlesArray, $numberOfPollsRequested)[$indexRequested]))
	{
   		$numberOfPollsToShow = sizeof(array_chunk($pollsTitlesArray, $numberOfPollsRequested)[$indexRequested]);

   		for($i = 0; $i < $numberOfPollsToShow; $i++)
		{
			echo array_chunk($pollsTitlesArray, $numberOfPollsRequested)[$indexRequested][$i];
			echo "<br>";
		}
	}
	else
		echo("error!");

	//echo json_encode(array_chunk($pollsTitlesArray, $numberOfPollsRequested)[0]);
?>
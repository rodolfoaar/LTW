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

	/////////////////////////////////
	//get all polls that are public//
	/////////////////////////////////
	try
	{
		$stmtPoll= $dbh->prepare('SELECT * FROM polls WHERE sharing = "public"');
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
	$pollsArray = array();

	foreach ($resultPoll as $poll)
	{
		$pollsArray[] = array('idPoll'=> $poll['idPoll'], 'title'=> $poll['title']);
	}

	$pollsArrayOrdered = array();

	foreach ($pollsArray as $key => $row)
	{
		$pollsArrayOrdered[$key] = $row['title'];
	}
	
	array_multisort($pollsArrayOrdered, SORT_ASC, $pollsArray);

	///////////
	//request//
	///////////
	$numberOfPollsRequested = $_POST['numberOfPolls'];
	$indexRequested = $_POST['index'];

	if (isset(array_chunk($pollsArray, $numberOfPollsRequested)[$indexRequested]))
	{
		echo json_encode(array_chunk($pollsArray, $numberOfPollsRequested)[$indexRequested]);
	}
	else
		echo("error!");
?>
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

	///////////
	//request//
	///////////
	$numberOfPollsRequested = $_POST['numberOfPolls'];
	$numberOfPollsInDB = sizeof($pollsArray);

	if($numberOfPollsInDB >= $numberOfPollsRequested)
	{
		$arr = array_slice($pollsArray, -$numberOfPollsRequested);
		echo json_encode($arr);
	}
	else
	{
		echo json_encode($pollsArray);
	}
?>
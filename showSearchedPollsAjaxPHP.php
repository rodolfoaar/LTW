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

	$wordToSearchFor = $_POST['wordToSearchFor'];
	$wordToSearchForDB = "%".$wordToSearchFor."%";
	//$wordToSearchFor = "games";

	/////////////////////////////////////////////////////
	//get all polls that are public and have "the word"//
	/////////////////////////////////////////////////////
	try
	{
		$stmtPoll= $dbh->prepare('SELECT * FROM polls WHERE sharing = "public" AND title LIKE :word');
		$stmtPoll->bindParam(':word', $wordToSearchForDB);
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

	echo json_encode($pollsArray);
?>
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

	if((isset($_POST['pollToFind'])) && (trim($_POST['pollToFind']) != ""))
		$pollToFind = $_POST['pollToFind'];

	$stmtPollToFind = $dbh->prepare('SELECT * FROM polls WHERE title = :title');
	$stmtPollToFind->bindParam(':title', $pollToFind);
	$stmtPollToFind->execute();
	$result = $stmtPollToFind->fetchAll();

	if(count($result) == 0)
		die("No poll with the name $pollToFind");

	echo("the poll with the name $result[0]['title']");
?>
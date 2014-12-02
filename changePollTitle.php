<?php

	if (!isset($_POST['idPoll'])) die('No id');
	if (!isset($_POST['titlePoll']) || trim($_POST['titlePoll']) == '') die('Title is mandatory');

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

	$idPoll = $_POST['idPoll'];
	$titlePoll = $_POST['titlePoll'];

	$stmt = $dbh->prepare('UPDATE polls SET title = :titlePoll WHERE idPoll = :idPoll');
	$stmt->bindParam(':titlePoll', $titlePoll);
	$stmt->bindParam(':idPoll', $idPoll);
	$stmt->execute();

	header('Location: index.php');
?>
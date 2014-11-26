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

	$idUser = 1;

	$stmt = $dbh->prepare('INSERT INTO polls (idUser, title)
				VALUES (:idPoll, :title)');

	$stmt->bindParam(':idPoll', $idUser);
	$stmt->bindParam(':title', $_POST['pollTitle']);
	$stmt->execute();

	$id = $dbh->lastInsertId();

	$originalFileName = "images/originals/$id.jpg";

	move_uploaded_file($_FILES['picture']['tmp_name'], $originalFileName);

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
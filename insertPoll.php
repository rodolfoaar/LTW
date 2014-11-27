<?php
	///////////////////////////
	//connection to data base//
	///////////////////////////
    /*
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

	//////////////////////////
	//						//
	//		TO CHANGE		//
	//		(ID USER)		//
	//////////////////////////
	$idUser = 1;

	///////////////////////////////////////////////
	//verify if the poll's name already exists...//
	///////////////////////////////////////////////
	if((isset($_POST['pollTitle'])) && (trim($_POST['pollTitle']) != ""))
		$pollTitle = $_POST['pollTitle'];

	$stmtPollsTitle = $dbh->prepare('SELECT * FROM polls WHERE title = :title');
	$stmtPollsTitle->bindParam(':title', $pollTitle);
	$stmtPollsTitle->execute();
	$result = $stmtPollsTitle->fetchAll();

	if(count($result) != 0)
		die("Poll's name already taken!");
    */

	////////////////////////////////////
	//don't forget to verify fields...//
	////////////////////////////////////
	if((isset($_POST['pollQuestion'])) && (trim($_POST['pollQuestion']) != ""))
		$pollQuestion = $_POST['pollQuestion'];

	$stmtPollsQuestions = $dbh->prepare('INSERT INTO pollsQuestions (idPoll, question)
				VALUES (:idPoll, :question)');
	$stmtPollsQuestions->bindParam(':idPoll', $idPoll);
	$stmtPollsQuestions->bindParam(':question', $pollQuestion);
	$stmtPollsQuestions->execute();

	$idQuestion = $dbh->lastInsertId();


	$stmtPollsQuestions = $dbh->prepare('INSERT INTO pollsChoices (idPollQuestion, choice)
				VALUES (:idPollQuestion, :choice)');

	$MAX_NUMBER_OF_CHOICES = $_POST['MAX_NUMBER_OF_CHOICES'];
	
	for($i = 1; $i < $MAX_NUMBER_OF_CHOICES; $i++)
	{
		if((isset($_POST['pollChoice_'.$i])) && (trim($_POST['pollChoice_'.$i]) != ""))
		{
			$stmtPollsQuestions->bindParam(':idPollQuestion', $idQuestion);
			$stmtPollsQuestions->bindParam(':choice', $_POST['pollChoice_'.$i]);
			$stmtPollsQuestions->execute();
		}
	}
?>

<html>
	<head>
	</head>
	<body>
		<form action="showPolls.php">
			<input type="submit" value="See polls...">
		</form>
	</body>
</html>
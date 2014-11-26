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

	//////////////////////////
	//						//
	//		TO CHANGE		//
	//		(ID USER)		//
	//////////////////////////
	$idUser = 1;

	$stmtPolls = $dbh->prepare('INSERT INTO polls (idUser, title)
				VALUES (:idUser, :title)');
	$stmtPolls->bindParam(':idUser', $idUser);
	$stmtPolls->bindParam(':title', $_POST['pollTitle']);
	$stmtPolls->execute();

	$idPoll = $dbh->lastInsertId();

	$originalFileName = "images/originals/$idPoll.jpg";

	move_uploaded_file($_FILES['picture']['tmp_name'], $originalFileName);

	////////////////////////////////////
	//don't forget to verify fields...//
	////////////////////////////////////
	if((isset($_POST['pollTitle'])) && ($_POST['pollTitle'] != " "))
		$pollTitle = $_POST['pollTitle'];

	if((isset($_POST['pollQuestion'])) && ($_POST['pollQuestion'] != " "))
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
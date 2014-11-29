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

	$poolTitle = $_POST['pollsTitles'];

	/////////////////////
	//get poll selected//
	/////////////////////
	try
	{
		$stmtPoll= $dbh->prepare("SELECT * FROM polls WHERE title = '$poolTitle'");
		$stmtPoll->execute();
		$resultPoll = $stmtPoll->fetchALL();
	}
	catch (PDOException $e)
	{
		die($e->getMessage());
	}

	$idPoll = $resultPoll[0]['idPoll'];

	/////////////////////
	//get poll question//
	/////////////////////
	try
	{
		$stmtQuestions= $dbh->prepare("SELECT * FROM pollsQuestions WHERE idPoll = '$idPoll'");
		$stmtQuestions->execute();
		$resultQuestions = $stmtQuestions->fetchALL();
	}
	catch (PDOException $e)
	{
		die($e->getMessage());
	}


	$idPollQuestion = $resultQuestions[0]['idPollQuestion'];
	$pollQuestion = $resultQuestions[0]['question'];

	/////////////////////////////
	//get poll question choices//
	/////////////////////////////
	try
	{
		$stmtChoices= $dbh->prepare("SELECT * FROM pollsChoices WHERE idPollQuestion = '$idPollQuestion'");
		$stmtChoices->execute();
		$resultChoices = $stmtChoices->fetchALL();
	}
	catch (PDOException $e)
	{
		die($e->getMessage());
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	</head>
	<body>
		<form action="xxx.php" method="POST">
			<h1> <?= $poolTitle?> </h1>
			 <img src="<?= 'images/originals/'.$idPoll.'.jpg'?>" alt="<?= $idPollQuestion?>"> 
			<h2> <?= $pollQuestion?> </h2>
			<?php
				foreach ($resultChoices as $choices)
				{
					?>
					<input type="radio" name="pollChoice" value="<?= $choices['id']?>">
					<?= $choices['choice']?><br><?php
				}
			?>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>
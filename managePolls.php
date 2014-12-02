<?php

	session_set_cookie_params(0);
	session_start();

	require_once 'database/user.php';
	require_once 'database/sqlite.php';
	require_once 'database/validation.php';

	$idPoll = cleanInput($_GET['id']);

	if(!is_numeric($idPoll))
	{
		header('Location: index.php');
		die();
	}

	$sqlite = new SQLite();
	$poll = $sqlite->getPoll($idPoll);

	include ('templates/header.php');
?>

<section id="result_poll">
	<h1><?= $poll['title']?></h1>
	<form action="changePollTitle.php" method="post">
		<input type="hidden" name="idPoll" value="<?= $idPoll?>">
		<label>New title:
			<input type="text" name="titlePoll" value="<?= $poll['title']?>">
		</label>
		<input type="submit" value="Save"> <br><br>
	</form>
</section>

<?php include ('templates/footer.php'); ?>



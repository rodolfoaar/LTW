<?php

	if (!isset($_POST['idPoll'])) die('No id');
	if (!isset($_POST['titlePoll']) || trim($_POST['titlePoll']) == '') die('Title is mandatory');

	session_set_cookie_params(0);
	session_start();

	require_once 'database/user.php';
	require_once 'database/sqlite.php';
	require_once 'database/validation.php';

	$sqlite = new SQLite();

	$idPoll = $_POST['idPoll'];
	$titlePoll = $_POST['titlePoll'];

	$pollQuestions = $sqlite->getPollQuestions($idPoll);

	foreach ($pollQuestions as $questions)
	{
		foreach ($questions as $key)
		{
			if((isset($key['choiceCount']) && $key['choiceCount'] > 0))
			{
				die("The poll has already been voted on and can not chage the name!");
			}
				
		}
	}

	$sqlite->changePollName($idPoll, $titlePoll);

	header('Location: index.php');
?>

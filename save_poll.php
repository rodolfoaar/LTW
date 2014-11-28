<?php

session_set_cookie_params(0);
session_start();

require_once 'database/validation.php';
require_once 'database/poll.php';

$valid = new Validation();
$validTitle = $valid->cleanInput($_POST['pollTitle']);

$poll = new Poll();
$idPoll = $poll->createPoll($_SESSION['userId'], $validTitle, $_POST['privatePoll']);
$poll->saveImgPoll($idPoll, $_FILES['picture']['tmp_name']);


?>


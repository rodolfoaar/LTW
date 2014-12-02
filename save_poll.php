<?php

session_set_cookie_params(0);
session_start();

require_once 'database/poll.php';

$poll = new Poll();
$poll->createPoll($_SESSION['userId'], $_POST, $_FILES['picture']['tmp_name']);

header('Location: view_user.php');

?>


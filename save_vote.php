<?php

session_set_cookie_params(0);
session_start();

require_once 'database/poll.php';

$poll = new Poll();
$poll->submitPoll($_POST);

header('Location: view_user.php');

?>

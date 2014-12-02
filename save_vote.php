<?php

session_set_cookie_params(0);
session_start();

require_once 'database/poll.php';

$poll = new Poll();
$poll->submitPoll($_POST);

// Add poll ID to voted poll array
$_SESSION['pollVotes'][] = $_POST['idPoll'];

//Redirect to poll results
$linkResult = "results_poll?id=".$_POST['idPoll'];
header("Location: $linkResult");

?>

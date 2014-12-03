<?php

session_set_cookie_params(0);
session_start();

require_once 'database/poll.php';

if(!isset($_POST))
{
    header('Location: index.php');
    die();
}

$poll = new Poll();
$poll->createPoll($_SESSION['userId'], $_POST, $_FILES['picture']['tmp_name'], $_POST['privatePoll']);

header('Location: view_user.php');

?>


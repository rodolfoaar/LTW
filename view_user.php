<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';
require_once 'database/sqlite.php';

//If user is NOT logged in, redirects the browser to index.php
$user = new User();
$user->isUserLoggedIn();

$sqlite = new SQLite();
$userPolls = $sqlite->getUserPolls($_SESSION['userId']);

include ('templates/header.php');

?>

<section id="my_polls">

    <h2>My Polls
        <a id="create_poll" href="createPoll.php">Create new poll</a>
    </h2>

    <?php foreach($userPolls as $poll)
    {?>
        <h3>
            <?= $poll['title']; ?>
            <a href="answerPoll.php?id=<?= $poll['idPoll']; ?>"> Poll </a>
            <a href="results_poll.php?id=<?= $poll['idPoll']; ?>"> Results </a>
            <a href="managePolls.php?id=<?= $poll['idPoll']; ?>"> Manage </a>
        </h3>
    <?php }?>

</section>

<?php include ('templates/footer.php'); ?>
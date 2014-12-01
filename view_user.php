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

    <h2>My Polls</h2>

    <?php foreach($userPolls as $poll)
    {?>
        <h3>
            <a href="answerPoll.php?id=<?= $poll['idPoll']; ?>">
                <img src="" alt="Poll image">
                <?= $poll['title']; ?>
            </a>
        </h3>
    <?php }?>

</section>

<?php include ('templates/footer.php'); ?>
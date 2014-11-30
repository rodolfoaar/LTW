<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';

//If user is NOT logged in, redirects the browser to index.php
$user = new User();
$user->isUserLoggedIn();

include ('templates/header.php');

?>

    <a id="create_poll" href="createPoll.php">Create Poll</a>
    <a id="show_all_polls" href="showPolls.php">Show Polls</a>
    <a id="user_log_out" href="log_out.php">Log Out</a>

<?php include ('templates/footer.php'); ?>
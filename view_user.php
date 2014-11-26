<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';

$user = new User();

//If user is NOT logged in, redirects the browser to index.php
if(!$user->isUserLoggedIn())
{
    header('Location: index.php');
    die();
}

include ('templates/header.php');

include ('createPoll.php');

?>
    <a id="user_log_out" href="log_out.php">Log Out</a>
<?php

include ('templates/footer.php');
?>
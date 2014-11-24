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

?>

    <h1>Registered User Home Page</h1>
    <h2>Welcome, <? echo $_SESSION['user'];?>!</h2>

<?php include ('templates/footer.php');?>
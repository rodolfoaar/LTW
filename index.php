<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';

$user = new User();

//If user is NOT logged in, redirects the browser to login.php
if(!$user->isUserLoggedIn())
{
    header('Location: login.php');
    die();
}

include ('templates/header.php');

?>

<h1>Registered User Home Page</h1>

<?php include ('templates/footer.php');?>
<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';

$user = new User();

//If user is already logged in, redirects the browser to index.php
if($user->isUserLoggedIn())
{
    header('Location: view_user.php');
    die();
}

//If the user entered wrong username / password
if(isset($_GET['error']))
{
    if($_GET['error'] === 'username')
    {
        $response = "Invalid username field.";
    }
    else
    {
        $response = "Please enter a correct username and password";
    }
}

include ('templates/header.php');

if(isset($response))
{?>
    <h4><? echo $response ?></h4>
<?}

include ('templates/sign_up.html');

include ('templates/sign_in.html');

include ('templates/footer.php');

?>

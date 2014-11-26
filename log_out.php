<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';

$user = new User();
$user->logOutUser();

?>
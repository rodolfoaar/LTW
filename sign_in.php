<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';
require_once 'database/validation.php';

$info_sign_in = validateSignIn($_POST['username_sign_in'], $_POST['password_sign_in']);

$user = new User();
$user->logInUser($info_sign_in['username'], $info_sign_in['password']);

?>
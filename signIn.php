<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';
require_once 'database/validation.php';

$validate = new Validation();
$validate->validateUsername($_POST['username_sign_in']);
$username = $validate->cleanSpacesSlashes($_POST['username_sign_in']);
$password = $validate->cleanSpacesSlashes($_POST['password_sign_in']);

$user = new User();
$user->validateUser($username, $password)

?>
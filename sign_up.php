<?php

session_set_cookie_params(0);
session_start();


require_once 'database/user.php';
require_once 'database/validation.php';

$userInfo = array(
    'username' => $_POST['username'],
    'password' => $_POST['password'],
    'confirmPassword' => $_POST['confirmPassword'],
    'age' => $_POST['age'],
    'gender' => $_POST['gender'],
    'email' => $_POST['email']);

$valid = new Validation();
$cleanUserInfo = $valid->validateSignUp($userInfo);

$user = new User();
$user->createUser($cleanUserInfo);

header('Location: view_user.php');

?>
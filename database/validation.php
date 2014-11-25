<?php

function validateSignIn($username, $password)
{
    session_unset();

    $submit_sign_in = true;
    $_SESSION['formSignIn']['username'] = $_POST['username_sign_in'];
    $_SESSION['formSignIn']['password'] = $_POST['password_sign_in'];

    $data = cleanSpacesSlashes($username);

    if (!isset($data) || $data === '' || strlen($data) > 20) {
        $_SESSION['errorSignIn']['username'] = "Invalid username.";
        $submit_sign_in = false;
    }

    $info_sign_in = array('username' => $data);

    $data = cleanSpacesSlashes($password);

    if(!isset($data) || $data === '')
    {
        $_SESSION['errorSignIn']['password'] = "Invalid password.";
        $submit_sign_in = false;
    }

    $info_sign_in['password'] = $data;

    if($submit_sign_in)
    {
        session_unset();
        return $info_sign_in;
    }

    header('Location: index.php');
    die();
}

//========================================

function cleanSpacesSlashes($formField)
{
    $data = trim($formField);
    $data = stripslashes($data);
    return $data;
}

//========================================

function getFieldVal($fv)
{
    if(isset($fv))
    {
        return $fv;
    }
}
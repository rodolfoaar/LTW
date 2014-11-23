<?php

require_once 'sqlite.php';

class User {

    //========================================

    function validateUser($un, $pwd)
    {
        $sqlite = new SQLite();
        $ensure_credentials = $sqlite->checkUserPassword($un, md5($pwd));

        if($ensure_credentials)
        {
            $_SESSION['status'] =  'authorized';
            return true;
        }

        return false;
    }

    //========================================

    function logOutUser()
    {
        if(isset($_SESSION['status']))
        {
            session_unset();
            session_destroy();
        }
    }

    //========================================

    function isUserLoggedIn()
    {
        if($_SESSION['status'] != 'authorized')
        {
            return false;
        }

        return true;

    }

    //========================================

    function createUser($userInfo)
    {
        if(isset($userInfo['username']) && isset($userInfo['password']) && isset($userInfo['confirmPassword']))
        {

            if($userInfo['username'] == " ")
                die("Username must have at least one letter");

            if($userInfo['password'] != $userInfo['confirmPassword'])
                die("Incorrect password!");

            $sqlite = new SQLite();

            if($sqlite->isUserTaken($userInfo['username']))
                die("The username is already in use!");

            $sqlite->addUser($userInfo);

            return true;
        }
        else
            die("Enter username and password");
    }

}

?>
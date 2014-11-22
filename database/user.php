<?php

require_once 'sqlite.php';

class User {


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

    function logOutUser()
    {
        if(isset($_SESSION['status']))
        {
            session_unset();
            session_destroy();
        }
    }

    function isUserLoggedIn()
    {
        if($_SESSION['status'] != 'authorized')
        {
            return false;
        }

        return true;

    }
}

?>
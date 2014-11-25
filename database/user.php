<?php

require_once 'sqlite.php';

class User {

    //========================================

    public function logInUser($un, $pwd)
    {
        $sqlite = new SQLite();
        $ensure_credentials = $sqlite->checkUserPassword($un, $pwd);

        if($ensure_credentials)
        {
            $_SESSION['user'] = $un;
            $_SESSION['status'] =  'authorized';
            header('Location: view_user.php');
            die();
        }
        else
        {
            $_SESSION['signIn'] = 'Please enter a correct username and password.';
            header('Location: index.php');
            die();
        }
    }

    //========================================

    public function logOutUser()
    {
        if(isset($_SESSION['status']))
        {
            session_unset();
            session_destroy();
        }
    }

    //========================================

    public function isUserLoggedIn()
    {
        if($_SESSION['status'] != 'authorized')
        {
            return false;
        }

        return true;

    }

    //========================================

    public function createUser($userInfo)
    {
        $sqlite = new SQLite();

        if($sqlite->isUserTaken($userInfo['username']))
        {
            $_SESSION['signUp'] = 'Username is already in use.';
            header('Location: index.php');
            die();
        }

        $sqlite->addUser($userInfo);

        $_SESSION['user'] = $userInfo['username'];
        $_SESSION['status'] =  'authorized';
        header('Location: view_user.php');
        die();
    }

}

?>
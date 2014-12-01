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
            $_SESSION['userId'] = $sqlite->getUserID($un);
            $_SESSION['status'] =  'authorized';
            header('Location: view_user.php');
            die();
        }
        else
        {
            $_SESSION['signIn'] = 'Please enter a correct username and password.';
            header('Location: account.php');
            die();
        }
    }

    //========================================

    public function logOutUser()
    {
        session_unset();
        session_destroy();
        header('Location: index.php');
    }

    //========================================

    public function isUserLoggedIn()
    {
        if(!isset($_SESSION['status']) || ($_SESSION['status'] != 'authorized'))
        {
            header('Location: index.php');
            die();
        }
    }

    //========================================

    public function createUser($userInfo)
    {
        $sqlite = new SQLite();

        if($sqlite->isUserTaken($userInfo['username']))
        {
            $_SESSION['signUp'] = 'Username is already in use.';
            header('Location: account.php');
            die();
        }

        $sqlite->addUser($userInfo);
        $_SESSION['signUp'] = 'Username has successfully created.';
        header('Location: account.php');
        die();
    }

}

?>
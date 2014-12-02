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
            $_SESSION['username'] = $un;
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

        $headers = "From: webmaster@LTWmail.com" . "\r\n" . "CC: " . $userInfo['email'];
        $to = $userInfo['email'];
        $subject = "LTW Online Polls signUp";
        $txt = "You successfully signUp to LTW Online Polls with username: " . $userInfo['username'];
        mail($to,$subject,$txt,$headers);

        $sqlite->addUser($userInfo);
        $_SESSION['signUp'] = 'Username has successfully created.';
        header('Location: account.php');
        die();
    }

    //========================================

    public function checkUserVote($idPoll)
    {
        if(isset($_SESSION['pollVotes']))
        {
            foreach($_SESSION['pollVotes'] as $votedPoll)
            {
                if($votedPoll === $idPoll)
                {
                    return true;
                }
            }
        }

        return false;

    }

}

?>
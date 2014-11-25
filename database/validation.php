<?php

class Validation
{
    private $submit_sign_in;

    public function validateSignIn($username, $password)
    {
        session_unset();

        $this->submit_sign_in = true;
        $_SESSION['formSignIn']['username'] = $username;
        $_SESSION['formSignIn']['password'] = $password;

        $data = $this->validateUsername($username);

        $info_sign_in = array('username' => $data);

        $data = $this->validatePassword($password);

        $info_sign_in['password'] = $data;

        if ($this->submit_sign_in) {
            session_unset();
            return $info_sign_in;
        }

        header('Location: index.php');
        die();
    }

//========================================

    public function validateUsername($un)
    {
        $data = $this->cleanInput($un);

        if (empty($un)) {
            $_SESSION['errorSignIn']['username'] = "Username is required.";
            $this->submit_sign_in = false;
            return false;
        } else {

            if (!isset($data) || $data === '' || strlen($data) > 20) {
                $_SESSION['errorSignIn']['username'] = "Invalid username.";
                $this->submit_sign_in = false;
                return false;
            }
        }

        return $data;
    }

//========================================

    public function validatePassword($pass)
    {
        $data = $this->cleanInput($pass);

        if (empty($pass)) {
            $_SESSION['errorSignIn']['password'] = "Password is required.";
            $this->submit_sign_in = false;
            return false;
        } else {

            if (!isset($data) || $data === '') {
                $_SESSION['errorSignIn']['password'] = "Invalid password.";
                $this->submit_sign_in = false;
            }
        }

        return $data;
    }

//========================================

    public function cleanInput($formField)
    {
        $data = trim($formField);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

//========================================

function getFieldVal($fv)
{
    if (isset($fv))
        return $fv;
}

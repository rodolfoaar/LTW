<?php

class Validation
{
    private $submit_form;

    public function validateSignIn($username, $password)
    {
        session_unset();

        $this->submit_form = true;
        $_SESSION['formSignIn']['username'] = $username;
        $_SESSION['formSignIn']['password'] = $password;

        $data = $this->validateUsername($username);

        $info_sign_in = array('username' => $data);

        $data = $this->validatePassword($password);

        $info_sign_in['password'] = $data;

        if ($this->submit_form) {
            session_unset();
            return $info_sign_in;
        }

        header('Location: index.php');
        die();
    }

//========================================

    public function validateSignUp($userInfo)
    {
        session_unset();

        $this->submit_form = true;
        $_SESSION['formSignUp']['username'] = $userInfo['username'];
        $_SESSION['formSignUp']['password'] = $userInfo['password'];
        $_SESSION['formSignUp']['confirmPassword'] = $userInfo['confirmPassword'];
        $_SESSION['formSignUp']['age'] = $userInfo['age'];
        $_SESSION['formSignUp']['gender'] = $userInfo['gender'];
        $_SESSION['formSignUp']['email'] = $userInfo['email'];

        $data = $this->validateUsername($userInfo['username']);
        $info_sign_up = array('username' => $data);

        $data = $this->validatePassword($userInfo['password']);
        $info_sign_up['password'] = $data;

        $this->confirmPassword($userInfo['password'], $userInfo['confirmPassword']);

        $data = $this->validateAge($userInfo['age']);
        $info_sign_up['age'] = $data;

        $data = $this->validateGender($userInfo['gender']);
        $info_sign_up['gender'] = $data;

        $data = $this->validateEmail($userInfo['email']);
        $info_sign_up['email'] = $data;

        if ($this->submit_form) {
            session_unset();
            return $info_sign_up;
        }

        header('Location: index.php');
        die();
    }


//========================================

    public function validateUsername($un)
    {
        $data = $this->cleanInput($un);

        if (empty($un)) {
            $_SESSION['errorMsg']['username'] = "Username is required.";
            $this->submit_form = false;
            return false;
        } else {

            if (!isset($data) || $data === '' || strlen($data) > 20) {
                $_SESSION['errorMsg']['username'] = "Invalid username.";
                $this->submit_form = false;
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
            $_SESSION['errorMsg']['password'] = "Password is required.";
            $this->submit_form = false;
            return false;
        } else {

            if (!isset($data) || $data === '') {
                $_SESSION['errorMsg']['password'] = "Invalid password.";
                $this->submit_form = false;
                return false;
            }
        }

        return $data;
    }

//========================================

    public function confirmPassword($pass, $confPass)
    {
        $p = $this->cleanInput($pass);
        $cp = $this->cleanInput($confPass);

        if (empty($confPass)) {
            $_SESSION['errorMsg']['confirmPassword'] = "Confirm Password is required.";
            $this->submit_form = false;
            return false;
        } else {

            if (!isset($cp) || $cp === '') {
                $_SESSION['errorMsg']['confirmPassword'] = "Invalid confirm password.";
                $this->submit_form = false;
                return false;
            }
        }

        if($p !== $cp)
        {
            $this->submit_form = false;
        }

    }

//========================================

    public function validateAge($age)
    {
        $data = $this->cleanInput($age);

        if (empty($age)) {
            $_SESSION['errorMsg']['age'] = "Age is required.";
            $this->submit_form = false;
            return false;
        } else {

            if (!filter_var($data, FILTER_VALIDATE_INT)) {
                $_SESSION['errorMsg']['age'] = "Invalid age.";
                $this->submit_form = false;
                return false;
            }
        }

        return $data;
    }

//========================================

    public function validateGender($gender)
    {
        $data = $this->cleanInput($gender);

        if (empty($gender)) {
            $_SESSION['errorMsg']['gender'] = "Gender is required.";
            $this->submit_form = false;
            return false;
        } else {

            if (!isset($data) || $data === '' || strlen($data) > 20) {
                $_SESSION['errorMsg']['gender'] = "Invalid gender.";
                $this->submit_form = false;
                return false;
            }
        }

        return $data;
    }

//========================================

    public function validateEmail($email)
    {
        $data = $this->cleanInput($email);

        if (empty($email)) {
            $_SESSION['errorMsg']['email'] = "Email is required.";
            $this->submit_form = false;
            return false;
        } else {

            if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errorMsg']['email'] = "Invalid email.";
                $this->submit_form = false;
                return false;
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

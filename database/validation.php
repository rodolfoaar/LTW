<?php

class Validation
{
    private $submit_form;

    public function validateSignIn($username, $password)
    {
        session_unset();

        $this->submit_form = true;
        $_SESSION['formSignIn']['username'] = $username;

        $data = $this->validateField('username', $username, 'errorSignIn');

        $info_sign_in = array('username' => $data);

        $data = $this->validateField('password', $password, 'errorSignIn');


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
        $_SESSION['formSignUp']['email'] = $userInfo['email'];

        $data = $this->validateField('username', $userInfo['username'], 'errorSignUp');
        $info_sign_up = array('username' => $data);

        $data = $this->validateField('password', $userInfo['password'], 'errorSignUp');
        $info_sign_up['password'] = $data;

        $confPass = $this->validateField('confirmPassword', $userInfo['confirmPassword'], 'errorSignUp');

        if ($data !== $confPass) {
            $this->submit_form = false;
            $_SESSION['errorSignUp']['confirmPassword'] = "Doesn't match password.";
        }

        $data = $this->validateAge($userInfo['age'], 'errorSignUp');
        $info_sign_up['age'] = $data;

        $data = $this->validateField('gender', $userInfo['gender'], 'errorSignUp');
        $info_sign_up['gender'] = $data;

        $data = $this->validateEmail($userInfo['email'], 'errorSignUp');
        $info_sign_up['email'] = $data;

        if ($this->submit_form) {
            session_unset();
            return $info_sign_up;
        }

        header('Location: index.php');
        die();
    }


//========================================

    public function validateField($field, $fieldVal, $arrayError)
    {
        $data = cleanInput($fieldVal);

        if (empty($fieldVal)) {
            $_SESSION[$arrayError][$field] = $field . " is required.";
            $this->submit_form = false;
            return false;
        } else {

            if (!isset($data) || $data === '') {
                $_SESSION[$arrayError][$field] = "Invalid " . $field;
                $this->submit_form = false;
                return false;
            }
        }

        return $data;
    }

//========================================

    public function validateAge($fieldVal, $arrayError)
    {
        $data = cleanInput($fieldVal);

        if (empty($fieldVal)) {
            $_SESSION[$arrayError]['age'] = "Age is required.";
            $this->submit_form = false;
            return false;
        } else {

            if (!filter_var($data, FILTER_VALIDATE_INT)) {
                $_SESSION[$arrayError]['age'] = "Invalid age.";
                $this->submit_form = false;
                return false;
            }
        }

        return $data;
    }

//========================================

    public function validateEmail($fieldVal, $arrayError)
    {
        $data = cleanInput($fieldVal);

        if (empty($fieldVal)) {
            $_SESSION[$arrayError]['email'] = "email is required.";
            $this->submit_form = false;
            return false;
        } else {

            if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
                $_SESSION[$arrayError]['email'] = "Invalid email.";
                $this->submit_form = false;
                return false;
            }
        }

        return $data;
    }
}

//========================================

function cleanInput($formField)
{
    $data = trim($formField);
    $data = preg_replace('/[^\w\d\s\.!,\?]/', '', $data);
    return $data;
}

//========================================

function getFieldVal($fv)
{
    if (isset($fv))
        return $fv;
}

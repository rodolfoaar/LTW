<?php

class Validation
{
    public function validateUsername($username)
    {
        if(!isset($username) || $username === '' || strlen($username) > 20)
        {
            header('Location: index.php?error=username');
            die();
        }

    }

    //========================================

    public function cleanSpacesSlashes($formField)
    {
        $data = trim($formField);
        $data = stripslashes($data);
        return $data;
    }

}
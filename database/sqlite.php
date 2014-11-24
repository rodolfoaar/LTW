<?php

class SQLite
{
    private $dbh;

    //========================================

     public function __construct()
    {
        //establish connection to the database
        try
        {
            $this->dbh = new PDO('sqlite:polls.db');
            $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    //========================================

    public function checkUserPassword ($username, $password)
    {
        try
        {
            $stmt = $this->dbh->prepare('SELECT * FROM users WHERE username = :un AND password = :pwd');
            $stmt->bindParam(':un', $username);
            $stmt->bindParam(':pwd', md5($password));
            $stmt->execute();
            $userLoggedIn = $stmt->fetchAll();

            //Change Validation !!!!!!!!!!!!!!!!!!!
            if(count($userLoggedIn) != 1)
            {
                return false;
            }

            return true;
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    //========================================

    public function isUserTaken($username)
    {
        //verify if the username is already taken
        try
        {
            $stmt = $this->dbh->prepare('SELECT * FROM users WHERE username = :un');
            $stmt->bindParam(':un', $username);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if(count($result) != 0)
            {
                return true;

            }

            return false;

        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    //========================================

    public function addUser($userInfo)
    {
        //add user
        try
        {
            $stmt = $this->dbh->prepare('INSERT INTO users (username, password, age, gender, email)
				VALUES (:username, :password, :age, :gender, :email)');

            $stmt->bindParam(':username', $userInfo['username']);
            $stmt->bindParam(':password', md5($userInfo['password']));
            $stmt->bindParam(':age', $userInfo['age']);
            $stmt->bindParam(':gender', $userInfo['gender']);
            $stmt->bindParam(':email', $userInfo['email']);
            $stmt->execute();

            //echo "Successful registration";
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }
}
?>
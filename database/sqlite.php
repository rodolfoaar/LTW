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

    public function checkUserPassword ($username, $hashPassword)
    {
        try
        {
            $stmt = $this->dbh->prepare('SELECT * FROM users WHERE username = :un AND password = :pwd');
            $stmt->bindParam(':un', $username);
            $stmt->bindParam(':pwd', $hashPassword);
            $stmt->execute();
            $userLoggedIn = $stmt->fetchAll();

            if(count($userLoggedIn) != 1)
                return false;

            return true;
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }
}
?>
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

    public function getUserID($username)
    {
        try
        {
            $stmt = $this->dbh->prepare('SELECT idUser FROM users WHERE username = :un');
            $stmt->bindParam(':un', $username);
            $stmt->execute();
            $userLoggedIn = $stmt->fetch();

            return $userLoggedIn['idUser'];
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

            return $this->dbh->lastInsertId();

        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    //========================================

    public function insertPoll($idUser, $pollTitle, $sharing)
    {
        try
        {
            $stmt = $this->dbh->prepare('INSERT INTO polls (idUser, title, sharing) VALUES (:idUser, :title, :share)');
            $stmt->bindParam(':idUser', $idUser);
            $stmt->bindParam(':title', $pollTitle);
            $stmt->bindParam(':share', $sharing);
            $stmt->execute();

            return $this->dbh->lastInsertId();

        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    //========================================

    public function insertQuestion($idPoll, $questionText, $choicesArray)
    {
        try
        {
            $stmt = $this->dbh->prepare('INSERT INTO pollsQuestions (idPoll, question) VALUES (:idPoll, :question)');
            $stmt->bindParam(':idPoll', $idPoll);
            $stmt->bindParam(':question', $questionText);
            $stmt->execute();

            $questionID = $this->dbh->lastInsertId();

            foreach($choicesArray as $choice)
            {
                $this->insertChoice($questionID, $choice);
            }

        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }

    //========================================

    private function insertChoice($idPollQuestion, $choiceText)
    {
        try
        {
            $stmt = $this->dbh->prepare('INSERT INTO pollsChoices (idPollQuestion, choice, choiceCount) VALUES (:idPollQuestion, :choice, 0)');
            $stmt->bindParam(':idPollQuestion', $idPollQuestion);
            $stmt->bindParam(':choice', $choiceText);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }

    }

    //========================================

    public function getAllPolls()
    {
        $resultPoll = null;

        try
        {
            $stmtPoll = $this->dbh->prepare('SELECT * FROM polls');
            $stmtPoll->execute();
            $resultPoll = $stmtPoll->fetchAll();

            return $resultPoll;

        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }

        return $resultPoll;
    }

    //========================================

    public function getPoll($idPoll)
    {
        $resultPoll = null;

        try
        {
            $stmtPoll= $this->dbh->prepare('SELECT * FROM polls WHERE idPoll = :id');
            $stmtPoll->bindParam(':id', $idPoll);
            $stmtPoll->execute();
            $resultPoll = $stmtPoll->fetch();

            return $resultPoll;

        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }

        return $resultPoll;
    }

    //========================================

    public function getPollQuestions($idPoll)
    {
        /////////////////////
        //get poll question//
        /////////////////////
        try
        {
            $stmtQuestions = $this->dbh->prepare('SELECT * FROM pollsQuestions WHERE idPoll = :pollId');
            $stmtQuestions->bindParam(':pollId', $idPoll);
            $stmtQuestions->execute();
            $resultQuestions = $stmtQuestions->fetchALL();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }

        /////////////////////////////
        //get poll question choices//
        /////////////////////////////
        $pollArray = null;

        foreach($resultQuestions as $question)
        {
            $questionArray[] = $question;

            /////////////////////////////
            //get poll question choices//
            /////////////////////////////
            try
            {
                $stmtChoices = $this->dbh->prepare('SELECT * FROM pollsChoices WHERE idPollQuestion = :idQuestion');
                $stmtChoices->bindParam(':idQuestion', $question['idPollQuestion']);
                $stmtChoices->execute();
                $resultChoices = $stmtChoices->fetchAll();

                foreach($resultChoices as $choice)
                {
                    $questionArray[] = $choice;
                }

                $pollArray[] = $questionArray;
                unset($questionArray);
            }
            catch (PDOException $e)
            {
                die($e->getMessage());
            }

        }

        return $pollArray;

    }

    //========================================

    public function insertVote($idPollChoice)
    {
        //Get choiceCount
        try
        {
            $stmt = $this->dbh->prepare('SELECT * FROM pollsChoices WHERE idPollChoice = :choiceId');
            $stmt->bindParam(':choiceId', $idPollChoice);
            $stmt->execute();
            $choice = $stmt->fetch();

            $voteCount = $choice['choiceCount'];

        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }

        //Increment choiceCount
        $voteCount = $voteCount + 1;

        try
        {
            $stmt = $this->dbh->prepare('UPDATE pollsChoices SET choiceCount = :addVote WHERE idPollChoice = :choiceId');
            $stmt->bindParam(':addVote', $voteCount);
            $stmt->bindParam(':choiceId', $idPollChoice);
            $stmt->execute();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    //========================================

    public function getUserPolls($idUser)
    {
        $resultPoll = null;

        try
        {
            $stmtPoll= $this->dbh->prepare('SELECT * FROM polls WHERE idUser = :id');
            $stmtPoll->bindParam(':id', $idUser);
            $stmtPoll->execute();
            $resultPoll = $stmtPoll->fetchAll();

            return $resultPoll;

        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }

        return $resultPoll;
    }


}
?>
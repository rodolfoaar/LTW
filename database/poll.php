<?php

require_once 'sqlite.php';
require_once 'database/validation.php';

class Poll
{

    public function createPoll($idUser, $formInfo, $img_tmp_name)
    {
        $validTitle = cleanInput($formInfo['pollTitle']);

        if(!isset($sharing))
        {
            $sharing = 'public';
        }

        //Create poll in database
        $sqlite = new SQLite();
        $idPoll = $sqlite->insertPoll($idUser, $validTitle, $sharing);

        //Save poll image
        $this->saveImgPoll($idPoll, $img_tmp_name);

        //Save questions and choices
        $this->createQuestions($idPoll, $formInfo);
    }

    //========================================

    public function saveImgPoll($idPoll, $tmp_name)
    {
        $originalFileName = "images/originals/$idPoll.jpg";
        move_uploaded_file($tmp_name, $originalFileName);
    }

    //========================================

    public function createQuestions($idPoll, $formInfo)
    {
        $formKeys = array_keys($formInfo);
        $arrayPos = 0;
        $choicesArray = null;

        foreach($formKeys as $key)
        {
            $charPos = strpos($key, '_');
            $keyType = substr($key, 0, $charPos);

            if($keyType === 'pollQuestion')
            {
                if(!isset($questionText))
                {
                    $questionText = cleanInput($formInfo[$key]);
                }
                else
                {
                    $sqlite = new SQLite();
                    $sqlite->insertQuestion($idPoll, $questionText, $choicesArray);
                    $questionText = cleanInput($formInfo[$key]);
                    unset($choicesArray);
                    $arrayPos = 0;
                }
            }

            if($keyType === 'pollChoice')
            {
                if(!empty($formInfo[$key]))
                {
                    $choicesArray[$arrayPos] = cleanInput($formInfo[$key]);
                    $arrayPos = $arrayPos + 1;
                }
            }
        }

        if(isset($questionText) && isset($choicesArray))
        {
            $sqlite = new SQLite();
            $sqlite->insertQuestion($idPoll, $questionText, $choicesArray);
        }
    }

    //========================================

    public function submitPoll($userVotes)
    {
        $sqlite = new SQLite();

        foreach($userVotes as $vote)
        {
            $sqlite->insertVote($vote);
        }
    }


}

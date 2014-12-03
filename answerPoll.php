<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';
require_once 'database/sqlite.php';
require_once 'database/validation.php';

$idPoll = cleanInput($_GET['id']);

if(!is_numeric($idPoll))
{
    header('Location: index.php');
    die();
}

//Verify if user already voted in this poll
$user = new User();
$votedPoll = $user->checkUserVote($idPoll);

if($votedPoll)
{
    $linkResult = "results_poll.php?id=".$idPoll;
    header("Location: $linkResult");
    die();
}

$sqlite = new SQLite();
$poll = $sqlite->getPoll($idPoll);
$pollQuestions = $sqlite->getPollQuestions($idPoll);

include ('templates/header.php');

?>

    <section id="answer_form">
        <form action="save_vote.php" method="POST">
            <input type="text" name="idPoll" value="<?= $poll['idPoll'] ?>" hidden>
            <h1><?= $poll['title']?></h1>
            <img src="<?= 'images/originals/'.$poll['idPoll'].'.jpg'?>" alt="poll image">

            <ul>
                <?php
                foreach($pollQuestions as $questionArray)
                {
                    $firstElem = true;
                    $questionId = ''; ?>


                    <?php
                    foreach($questionArray as $questionElem)
                    {
                        if($firstElem)
                        {?>
                            <li><h2><?= $questionElem['question']?></h2></li>
                            <ul>

                            <?php
                            $questionId = $questionElem['idPollQuestion'];
                            $firstElem = false;
                        }
                        else
                        {?>
                            <li>
                                <input type="radio" name="questionId_<?= $questionId?>" value="<?= $questionElem['idPollChoice']?>" >
                                <?php echo $questionElem['choice']; ?>
                            </li>
                        <?php
                        }
                    }
                    ?>
                    </ul>
                    <?php
                    $firstElem = true;
                }
                ?>
            </ul>
            <input type="submit" value="Submit">
        </form>
    </section>

<?php include ('templates/footer.php'); ?>
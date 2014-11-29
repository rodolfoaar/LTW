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

$sqlite = new SQLite();
$poll = $sqlite->getPoll($idPoll);
$pollQuestions = $sqlite->getPollQuestions($idPoll);

include ('templates/header.php');

?>


<form action="xxx.php" method="POST">
    <h1><?= $poll['title']?></h1>
    <input type="text" name="pollId" value="<?= $poll['idPoll']?>" hidden>
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
                        <input type="radio" name="questionId_<?= $questionId?>" value="<?= $questionElem['choice']?>" >
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

<?php include ('templates/footer.php'); ?>
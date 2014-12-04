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

//Verify if user is allowed to see poll results
$user = new User();
$votedPoll = $user->checkUserVote($idPoll);

//Verify if user is poll owner
$sqlite = new SQLite();
$poll = $sqlite->getPoll($idPoll);

if($_SESSION['userId'] === $poll['idUser'])
{
    $votedPoll = true;
}

if(!$votedPoll)
{
    $linkResult = "answerPoll.php?id=".$idPoll;
    header("Location: $linkResult");
    die();
}

$pollQuestions = $sqlite->getPollQuestions($idPoll);

include ('templates/header.php');

?>

<section id="result_poll">

    <script src="js/share.js"></script>

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
                            <p>
                                <a href="#"><?php echo $questionElem['choice']; ?></a>
                                <a href="#"><?php echo $questionElem['choiceCount']; ?></a>
                            </p>
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

        <input type="button" value="Share" onclick="showShareForm()">
        <br><br>
        <p id="share" hidden="hidden"> Your name:
            <input type="text" id="username" value ="<?php if(isset($_SESSION['username'])) echo getFieldVal($_SESSION['username']); ?>" required="required">
            <br>e-mail of person with you want to share this poll:
            <input type="text" id="destinationMail" value ="" required="required">
            <input type="button" value="Send e-mail" onclick="sendMailtoShare()">
        </p>
        <p id="emailStatus" ></p>


</section>

<?php include ('templates/footer.php'); ?>



<?php

session_set_cookie_params(0);
session_start();

require_once 'database/sqlite.php';

$sqlite = new SQLite();
$allPolls = $sqlite->getAllPolls();

include ('templates/header.php'); ?>

<section id="polls">
    <table cellspacing="0">
        <tr>
            <th>idPoll</th><th>idUser</th><th>Title</th><th>Sharing</th><th>Vote</th>
        </tr>

        <?php foreach($allPolls as $poll)
        {?>
            <tr>
                <td><?=$poll['idPoll']?></td>
                <td><?=$poll['idUser']?></td>
                <td><?=$poll['title']?></td>
                <td><?=$poll['sharing']?></td>
                <td><a href="answerPoll.php?id=<?=$poll['idPoll']?>">Vote</a></td>
            </tr>
        <?php } ?>

    </table>
</section>


<?php include ('templates/footer.php'); ?>

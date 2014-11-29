<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';
require_once 'database/sqlite.php';

//If user is NOT logged in, redirects the browser to index.php
$user = new User();
$user->isUserLoggedIn();

$sqlite = new SQLite();
$allPolls = $sqlite->getAllPolls();

include ('templates/header.php');

?>

<table>
    <tr>
        <th>idPoll</th><th>idUser</th><th>Title</th><th>Sharing</th>
    </tr>

    <?php foreach($allPolls as $poll)
    {?>
    <tr>
        <td><?=$poll['idPoll']?></td>
        <td><?=$poll['idUser']?></td>
        <td><?=$poll['title']?></td>
        <td><?=$poll['sharing']?></td>
        <td><a href="answerPoll.php?id=<?=$poll['idPoll']?>">Link</a></td>
    </tr>
    <?php } ?>

</table>

<?php include ('templates/footer.php'); ?>


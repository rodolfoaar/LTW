<?php

session_set_cookie_params(0);
session_start();

require_once 'database/sqlite.php';

$sqlite = new SQLite();
$allPolls = $sqlite->getAllPolls();

include ('templates/header.php'); ?>



<?php include ('templates/footer.php'); ?>

<?php

session_set_cookie_params(0);
session_start();

require_once 'database/sqlite.php';

/*$sqlite = new SQLite();
$allPolls = $sqlite->getAllPolls();*/

include ('templates/header.php'); ?>

<section id="my_polls">
	<div id="lastPolls">
		<h2> Last Polls inserted: </h2>
		<h2 id="lastPollsInserted"></h2><br>
	</div>
</section>

<?php include ('templates/footer.php'); ?>
<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';
require_once 'database/sqlite.php';

include ('templates/header.php');

?>
<section id="my_polls">

	<div id="polls">
		<h2> Polls: </h2>
		<h2 id="allPolls"></h2><br>
	</div>
	<input type="button" id="" onClick="lessPolls()" value="<<">
	<input type="button" id="" onClick="morePolls()" value=">>">

	<div id="searchPoll">
		<h2> Search poll: </h2>
		<input id="wordToSearchFor" type="text" name="word" required="required">
		<h2 id="pollsFound"></h2><br>
	</div>
	<input type="button" id="" onClick="searchPolls()" value="search"><br><br>

</section>

<?php include ('templates/footer.php'); ?>
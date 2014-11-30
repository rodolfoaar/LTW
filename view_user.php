<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';

//If user is NOT logged in, redirects the browser to index.php
$user = new User();
$user->isUserLoggedIn();

include ('templates/header.php');

?>

<section id="polls">
    <h2>Polls</h2>
    <article>
        <h3><a href="#">Poll Title</a></h3>
        <img src="" alt="Poll image">
        <footer><span class="author">Poll Author</span></footer>
    </article>
</section>

<?php include ('templates/footer.php'); ?>
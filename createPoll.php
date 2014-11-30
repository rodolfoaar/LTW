<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';

//If user is NOT logged in, redirects the browser to index.php
$user = new User();
$user->isUserLoggedIn();

include ('templates/header.php');

?>

<form id="insert_poll" action="save_poll.php" method="POST" enctype="multipart/form-data">

    <fieldset>
        <legend>Poll</legend>

        <p>
            Insert title: <input id="poll_title" type="text" name="pollTitle" required="required">
            <input type="checkbox" name="privatePoll" value="private">Private Poll
        </p>

        <p>Insert image: <input type="file" name="picture" ></p>

        <ul id="poll_list">

            <li class="question">
                <p>Insert question:
                    <input class="poll_question" type="text" name="pollQuestion_1" required="required">
                    <input type="button" id="remove_question" value="Remove question" hidden>
                </p>

                <ul>
                    <p>Insert choices:</p>

                    <li>
                        <input type="text" name="pollChoice_2" required>
                    </li>

                    <li>
                        <input type="text" name="pollChoice_3" required>
                        <input type="button" id="add_question" onclick="addChoiceF(event)" value="+" >
                    </li>

                </ul>

            </li>

        </ul>

        <input type="button" id="add_another_question" value="Add question">
        <input type="submit" id="submitPoll" value="Submit poll">

    </fieldset>

</form>

<?php include ('templates/footer.php'); ?>
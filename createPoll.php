<form id="insert_poll" action="save_poll.php" method="POST">

    <fieldset>
        <legend>Poll</legend>

        <p>Insert title: <input id="poll_title" type="text" name="pollTitle" required="required"></p>

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
                        <input type="text" name="pollChoice_2" >
                    </li>

                    <li>
                        <input type="text" name="pollChoice_3" >
                        <input type="button" id="add_question" onclick="addChoiceF(event)" value="+" >
                    </li>

                </ul>

            </li>

        </ul>

        <input type="button" id="add_another_question" value="Add question">
        <input type="submit" id="submitPoll" value="Submit poll">

    </fieldset>

</form>

// Call setup after document loads
$(setUp);

//Initial setup
function setUp(){
    $("#insert_poll").submit(insertPoll)
    $("#add_another_question").click(addQuestionF);
}

//============================================================

var choice_block = $('<li><input type="text" name="pollChoice" > <input type="button" id="add_question" onclick="addChoiceF(event)" value="+" > <input type="button" id="remove_choice" onclick="removeChoiceF(event)" value="-" ></li>');

//============================================================

function addQuestionF(event)
{
    var question_block = $('<li class="question"> \
                                <p>Insert question: \
                                    <input class="poll_question" type="text" name="pollQuestion" required="required"> \
                                    <input type="button" id="remove_question" onclick="removeQuestionF(event)" value="Remove question" > \
                                </p> \
                                <ul> \
                                    <p>Insert choices:</p> \
                                    <li> \
                                        <input type="text" name="pollChoice" > \
                                    </li> \
                                    <li> \
                                        <input type="text" name="pollChoice" > \
                                        <input type="button" id="add_question" onclick="addChoiceF(event)" value="+" > \
                                    </li> \
                                </ul> \
                </li>');
    $("#poll_list").append(question_block);
}

//============================================================

function removeQuestionF(event)
{
    $(event.target).closest("li").remove();
}

//============================================================

function addChoiceF(event)
{
    $(event.target).parent().after(choice_block.clone());
}

//============================================================

function removeChoiceF(event)
{
    $(event.target).parent().remove();
}

//============================================================

function insertPoll(event)
{
    event.preventDefault();

    console.log($(event.target).parent().html());
}
// Call setup after document loads
$(setUp);

//Initial setup
function setUp(){
    $("#insert_poll").submit(insertPoll)
    $("#add_another_question").click(addChoiceF);
}

//============================================================

function addChoiceF(event)
{
    var question_block = $('<li class="question"><p>Insert question: <input class="poll_question" type="text" name="pollQuestion" required="required"> <input type="button" id="remove_question" onclick="removeChoiceF(event)" value="Remove question"></p></li>');
    var choice_block = $('<ul><p>Insert choices:</p></ul>');
    var choice_elem = '<li><input type="text" name="pollChoice" ></li>';

    for(var i=0; i<5; i++)
    {
        choice_block.append($(choice_elem));
    }
    question_block.append(choice_block);
    $("#poll_list").append(question_block);
}

//============================================================

function removeChoiceF(event)
{
    console.log("Click");
    $(event.target).closest("li").remove();
}

//============================================================

function insertPoll(event)
{
    event.preventDefault();

    console.log($(event.target).html());
}
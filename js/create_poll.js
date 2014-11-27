// Call setup after document loads
$(setUp);

//Initial setup
function setUp(){
    //$("#insert_poll").submit(insertPoll)
    $("#add_another_question").click(addQuestionF);
}

//============================================================

var choice_block = $('<li><input type="text" id="choice" name="pollChoice" > <input type="button" id="add_question" onclick="addChoiceF(event)" value="+" > <input type="button" id="remove_choice" onclick="removeChoiceF(event)" value="-" ></li>');
var ref_num = 3;
//============================================================

function addQuestionF(event)
{
    var question_block = $('<li class="question"> \
                                <p>Insert question: \
                                    <input class="poll_question" type="text" id="question" name="pollQuestion" required="required"> \
                                    <input type="button" id="remove_question" onclick="removeQuestionF(event)" value="Remove question" > \
                                </p> \
                                <ul> \
                                    <p>Insert choices:</p> \
                                    <li> \
                                        <input type="text" id="choice1" name="pollChoice" required> \
                                    </li> \
                                    <li> \
                                        <input type="text" id="choice2" name="pollChoice" required> \
                                        <input type="button" id="add_question" onclick="addChoiceF(event)" value="+" > \
                                    </li> \
                                </ul> \
                </li>');

    ref_num++;
    var question_name = 'pollQuestion_'.concat(ref_num.toString());
    question_block.find("#question").attr('name',question_name);

    ref_num++;
    var choice_1_name = 'pollChoice_'.concat(ref_num.toString());
    question_block.find("#choice1").attr('name',choice_1_name);

    ref_num++;
    var choice_2_name = 'pollChoice_'.concat(ref_num.toString());
    question_block.find("#choice2").attr('name',choice_2_name);

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
    var choice_num = choice_block.clone();

    ref_num++;
    var choice_name = 'pollChoice_'.concat(ref_num.toString());
    choice_num.find("#choice").attr('name',choice_name);

    $(event.target).parent().after(choice_num);
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
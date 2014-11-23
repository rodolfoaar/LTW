//Call setup after document loads
$(document).ready(setUp);

//Initial setup
function setUp()
{
    //Setup for submit event
    $("#signIn").submit(validateSignIn);
}

//Validate sign in
function validateSignIn(event)
{
    var username = $("input[name=username_sign_in]").val();
    var password = $("input[name=password_sign_in]").val();

    if(!username || !password)
    {
        alert("Sign In - Username and Password can't be blank!");
        event.preventDefault();
    }
}



<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';

$user = new User();

//If user is already logged in, redirects the browser to index.php
if($user->isUserLoggedIn())
{
    header('Location: view_user.php');
    die();
}

//If the user entered wrong username / password
if(isset($_GET['status']) && ($_GET['status'] == 'failed'))
{
    $response = false;
}

include ('templates/header.php');

if(isset($response))
{?>
    <h4>Please enter a correct username and password</h4>
<?}?>

<form action='signUp.php' method='POST' enctype="multipart/form-data">
    <fieldset id="signUp">
        <legend>Sign up</legend>

        <label> Username: <br>
            <input type='text' name='username' required="required"> <br>
        </label>

        <label> Password: <br>
            <input type='password' name='password' required="required"> <br>
        </label>

        <label> Confirm password: <br>
            <input type='password' name='confirmPassword' required="required"> <br>
        </label>

        <label> Age: <br>
            <input type="number" name='age' value="18" min="18" max="100" step="1"><br>
        </label>

        Sex: <br>
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="female">Female <br>

        <label> E-mail: <br>
            <input type="email" name="email" required="required"> <br>
        </label>

        <!--
        Telephone: <br>
        <input type='tel' name='telephone' required="required"> <br>

        Choose image for avatar: <br>
        <input type="file" name="userAvatar" required="required"> <br>
        !-->

        <input type="image" src="images/submit-icon.png"	 alt="Submit" align="right" width="64" height="64">
    </fieldset>
</form>

<form action='signIn.php' method='POST'>
    <fieldset fieldset id="signIn">
        <legend>Sign in</legend>
        Username: <br>
        <input type='text' name='username' required="required"> <br>
        Password: <br>
        <input type='password' name='password' required="required"> <br>
        <input type="image" src="images/submit-icon.png" alt="Submit" align="right" width="64" height="64">
    </fieldset>
</form>

<button>Click me</button>

<!--
<audio id="audio" controls autoplay loop>
    <source src="music/Spokey Dokey.mp3" type="audio/mpeg">
</audio>
!-->

<?php include ('templates/footer.php');?>

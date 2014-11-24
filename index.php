<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';

include 'database/validation.php';

//If user is already logged in, redirects the browser to index.php
$user = new User();
if($user->isUserLoggedIn())
{
    header('Location: view_user.php');
    die();
}

include ('templates/header.php');

?>

<!-- SIGN UP ================================================ -->

<form name="signUp" action='signUp.php' method='POST' enctype="multipart/form-data">
    <fieldset>
        <legend>Sign up</legend>

        <label> Username:
            <input type="text" name="username" required="required">
        </label>

        <label> Password:
            <input type="password" name="password" required="required">
        </label>

        <label> Confirm password:
            <input type="password" name="confirmPassword" required="required">
        </label>

        <label> Age:
            <input type="number" name="age" value="18" min="18" max="100" step="1">
        </label>

        Sex:
        <label>Male:
            <input type="radio" name="gender" value="male">
        </label>

        <label>Female:
            <input type="radio" name="gender" value="female">
        </label>

        <label> E-mail:
            <input type="email" name="email" required="required">
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


<!-- SIGN IN ================================================ -->

<form id="signIn" action="sign_in.php" method="post">
    <fieldset>
        <legend>Sign in</legend>

        <p class="error">* - required field</p>

        <label>Username:
            <input type="text" name="username_sign_in" value ="<?= getFieldVal($_SESSION['formSignIn']['username']); ?>" required="required">
            <span class="error">* <? echo getFieldVal($_SESSION['errorSignIn']['username']); ?></span>
</label>

<label>Password:
    <input type="password" name="password_sign_in" value ="<?= getFieldVal($_SESSION['formSignIn']['password']); ?>" required="required">
    <span class="error">* <? echo getFieldVal($_SESSION['errorSignIn']['password']); ?></span>
</label>

<input type="image" src="images/submit-icon.png" alt="Submit" align="right" width="64" height="64">

</fieldset>
</form>

<?

include ('templates/footer.php');

?>

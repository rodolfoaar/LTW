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

<form name="signUp" action='sign_up.php' method='POST' enctype="multipart/form-data">
    <fieldset>
        <legend>Sign up</legend>

        <h3 class="error"><?php echo getFieldVal($_SESSION['signUp']) ?></h3>

        <label> Username:
            <input type="text" name="username" value ="<?php echo getFieldVal($_SESSION['formSignUp']['username']); ?>" required="required">
            <span class="error">* <?php echo getFieldVal($_SESSION['errorSignUp']['username']); ?></span>
        </label>

        <br><br>

        <label> Password:
            <input type="password" name="password" required="required">
            <span class="error">* <?php echo getFieldVal($_SESSION['errorSignUp']['password']); ?></span>
        </label>

        <br><br>

        <label> Confirm password:
            <input type="password" name="confirmPassword" required="required">
            <span class="error">* <?php echo getFieldVal($_SESSION['errorSignUp']['confirmPassword']); ?></span>
        </label>

        <br><br>

        <label> Age:
            <input type="number" name="age" value="18" min="18" max="100" step="1">
            <span class="error">* <?php echo getFieldVal($_SESSION['errorSignUp']['age']); ?></span>
        </label>

        <br><br>

        Gender:
        <label>Male:
            <input type="radio" name="gender" value="male">
        </label>

        <label>Female:
            <input type="radio" name="gender" value="female">
        </label>
        <span class="error">* <?php echo getFieldVal($_SESSION['errorSignUp']['gender']); ?></span>

        <br><br>

        <label> E-mail:
            <input type="email" name="email" value ="<?php echo getFieldVal($_SESSION['formSignUp']['email']); ?>" required="required">
            <span class="error">* <?php echo getFieldVal($_SESSION['errorSignUp']['email']); ?></span>
        </label>

        <!--
        Telephone: <br>
        <input type='tel' name='telephone' required="required"> <br>

        Choose image for avatar: <br>
        <input type="file" name="userAvatar" required="required"> <br>
        !-->

        <p class="error">* - required field</p>

        <input type="image" src="images/submit-icon.png"	 alt="Submit" align="right" width="64" height="64">
    </fieldset>
</form>


<!-- SIGN IN ================================================ -->

<form id="signIn" action="sign_in.php" method="post">
    <fieldset>
        <legend>Sign in</legend>

        <h3 class="error"><?php echo getFieldVal($_SESSION['signIn']) ?></h3>

        <label class="user">Username:
            <input type="text" name="username_sign_in" value ="<?php echo getFieldVal($_SESSION['formSignIn']['username']); ?>" required="required">
            <span class="error">* <?php echo getFieldVal($_SESSION['errorSignIn']['username']); ?></span>
        </label>

        <br><br>

        <label class="pass">Password:
            <input type="password" name="password_sign_in" required="required">
            <span class="error">* <?php echo getFieldVal($_SESSION['errorSignIn']['password']); ?></span>
        </label>

        <p class="error">* - required field</p>

        <input type="image" src="images/submit-icon.png" alt="Submit" align="right" width="64" height="64">

    </fieldset>
</form>

<?

include ('templates/footer.php');

?>

<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';
include 'database/validation.php';

if($_SESSION['status'] === 'authorized')
{
    header('Location: view_user.php');
    die();
}
else
{
    $_SESSION['status'] = '';
}

// ===============

if (!isset($_SESSION['signUp']))
    $_SESSION['signUp'] = '';

if (!isset($_SESSION['formSignUp']['username']))
    $_SESSION['formSignUp']['username'] = '';
if (!isset($_SESSION['formSignUp']['email']))
    $_SESSION['formSignUp']['email'] = '';

if (!isset($_SESSION['errorSignUp']['username']))
    $_SESSION['errorSignUp']['username'] = '';
if (!isset($_SESSION['errorSignUp']['password']))
    $_SESSION['errorSignUp']['password'] = '';
if (!isset($_SESSION['errorSignUp']['confirmPassword']))
    $_SESSION['errorSignUp']['confirmPassword'] = '';
if (!isset($_SESSION['errorSignUp']['age']))
    $_SESSION['errorSignUp']['age'] = '';
if (!isset($_SESSION['errorSignUp']['gender']))
    $_SESSION['errorSignUp']['gender'] = '';
if (!isset($_SESSION['errorSignUp']['email']))
    $_SESSION['errorSignUp']['email'] = '';

// ===============

if (!isset($_SESSION['signIn']))
    $_SESSION['signIn'] = '';

if (!isset($_SESSION['formSignIn']['email']))
    $_SESSION['formSignIn']['username'] = '';

if (!isset($_SESSION['errorSignIn']['username']))
    $_SESSION['errorSignIn']['username'] = '';
if (!isset($_SESSION['errorSignIn']['password']))
    $_SESSION['errorSignIn']['password'] = '';

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
            <input type="number" name="age" min="1" value="<?php echo getFieldVal($_SESSION['formSignUp']['age']); ?>" step="1">
            <span class="error"><?php echo getFieldVal($_SESSION['errorSignUp']['age']); ?></span>
        </label>

        <br><br>

        Gender:
        <label>Male:
            <input type="radio" name="gender" value="male">
        </label>

        <label>Female:
            <input type="radio" name="gender" value="female">
        </label>
        <span class="error"><?php echo getFieldVal($_SESSION['errorSignUp']['gender']); ?></span>

        <br><br>

        <label> E-mail:
            <input type="email" name="email" value ="<?php echo getFieldVal($_SESSION['formSignUp']['email']); ?>" required="required">
            <span class="error">* <?php echo getFieldVal($_SESSION['errorSignUp']['email']); ?></span>
        </label>

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

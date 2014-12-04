<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';
include 'database/validation.php';

if (isset($_SESSION['status']))
{
    if ($_SESSION['status'] === 'authorized')
    {
        header('Location: view_user.php');
        die();
    }
    else
    {
        $_SESSION['status'] = '';
    }
}

// ===============

if (!isset($_SESSION['signUp']))
    $_SESSION['signUp'] = '';

if (!isset($_SESSION['formSignUp']['username']))
    $_SESSION['formSignUp']['username'] = '';
if (!isset($_SESSION['formSignUp']['email']))
    $_SESSION['formSignUp']['email'] = '';

// ===============

if (!isset($_SESSION['signIn']))
    $_SESSION['signIn'] = '';

if (!isset($_SESSION['formSignIn']['email']))
    $_SESSION['formSignIn']['username'] = '';

include ('templates/header.php');

?>
    <!-- SIGN IN ================================================ -->
    <section id="signIn">
        <form id="signIn" action="sign_in.php" method="post">
            <fieldset>
                <legend>Sign in</legend>

                <h3 class="error"><?php echo getFieldVal($_SESSION['signIn']) ?></h3>

                <label class="user">Username:
                    <input type="text" name="username_sign_in" value ="<?php echo getFieldVal($_SESSION['formSignIn']['username']); ?>" required="required">
                    <span class="error">*</span>
                </label>

                <br><br>

                <label class="pass">Password:
                    <input type="password" name="password_sign_in" required="required">
                    <span class="error">*</span>
                </label>

                <p class="error">* - required field</p>

                <input id="submit_form" type="submit" value="Submit">

            </fieldset>
        </form>
    </section>

    <!-- SIGN UP ================================================ -->

    <section id="signUp">
        <form name="signUp" action='sign_up.php' method='POST' enctype="multipart/form-data">
            <fieldset>
                <legend>Sign up</legend>

                <h3 class="error"><?php echo getFieldVal($_SESSION['signUp']) ?></h3>

                <label> Username:
                    <input type="text" name="username" value ="<?php echo getFieldVal($_SESSION['formSignUp']['username']); ?>" required="required">
                    <span class="error">*</span>
                </label>

                <br><br>

                <label> Password:
                    <input type="password" name="password" required="required">
                    <span class="error">*</span>
                </label>

                <br><br>

                <label> Confirm password:
                    <input type="password" name="confirmPassword" required="required">
                    <span class="error">*</span>
                </label>

                <br><br>

                <label> Age:
                    <input type="number" name="age" min="1" max="99" value="<?php echo getFieldVal($_SESSION['formSignUp']['age']); ?>" step="1">
                </label>

                <br><br>

                Gender:
                <br>
                <label>Male
                    <input type="radio" name="gender" value="male">
                </label>

                <label>Female
                    <input type="radio" name="gender" value="female">
                </label>

                <br><br>

                <label> E-mail:
                    <input type="email" name="email" value ="<?php echo getFieldVal($_SESSION['formSignUp']['email']); ?>" required="required">
                    <span class="error">*</span>
                </label>

                <p class="error">* - required field</p>

                <input id="submit_form" type="submit" value="Submit">

            </fieldset>
        </form>
    </section>

<?php

// ===============
$_SESSION['signUp'] = '';

$_SESSION['formSignUp']['username'] = '';
$_SESSION['formSignUp']['email'] = '';

// ===============
$_SESSION['signIn'] = '';

$_SESSION['formSignIn']['username'] = '';

include ('templates/footer.php'); ?>
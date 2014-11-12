<!DOCTYPE html>
<html>
	<head>
		<title>LTW Project</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./css/style.css">
	</head>
	<body>
		<fieldset id="signUp">
        	<legend>Sign up</legend>
        	<form action='signUp.php' method='POST'>
        		Username: <input type='text' name='username'><br>
				Password: <input type='password' name='password'><br>
				Confirm password: <input type='password' name='confirmPassword'><br>
				<input type='submit' value='sign up'>
			</form>
		</fieldset>

		<fieldset fieldset id="signIn">
        	<legend>Sign in</legend>
			<form action='signIn.php' method='POST'>
				Username: <input type='text' name='username'><br>
				Password: <input type='password' name='password'><br>
				<input type='submit' value='login'>
			</form>
		</fieldset>
	</body>
</html>
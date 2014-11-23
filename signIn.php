<?php

session_set_cookie_params(0);
session_start();

require_once 'database/user.php';

$user = new User();

if($user->validateUser($_POST['username'],$_POST['password']))
{
    header('Location: view_user.php');
    die();
}
else
{
    header('Location: index.php?status=failed');
    die();
}

//===========================================================

/*
	require_once 'init.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	//get username and password
	if($username && $password)
	{
		try
		{
			$hashPassword = md5($password);
			$stmt = $dbh->prepare("SELECT * FROM users WHERE username = '$username' AND password = '$hashPassword'");
			$stmt->execute();
			$userLoggedIn = $stmt->fetchAll();

			if(count($userLoggedIn) != 1)
				die("That password is incorrect!");
			else
				echo "User exists with id = ".$userLoggedIn[0]['id'];	
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		} 
	}
	else
		die("Enter username and password");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>LTW Project</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<form action='showPolls.php' method='POST'>
			Now we know the user exists (remember <?php echo $userLoggedIn[0]['id']?>)... let's see some polls! <br>
			<input type="submit" value="Submit">
			<input type="hidden" name="user" value="<?php echo $userLoggedIn[0]['id']?>">
		</form>
	</body>
</html>

*/
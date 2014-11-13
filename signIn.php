<?php

	//establish connection to the database
	try
	{
		$dbh = new PDO('sqlite:phplogin.db');
		$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
		die($e->getMessage());
	}

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
				echo "That password is incorrect!";
			else
				echo "User exists!";
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		} 
	}
	else
		die("Enter username and password");
?>
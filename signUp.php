<?php

	//establish connection to the database
	try
	{
		$dbh = new PDO('sqlite:db/phplogin.db');
		$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
		die($e->getMessage());
	}

	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];

	//get username and password
	if($username && $password && $confirmPassword)
	{
		if($password != $confirmPassword)
			die("Incorrect password!");

		//verify if the username is already taken
		try
		{
			$stmt_01 = $dbh->prepare("SELECT * FROM users WHERE username ='$username'");
			$stmt_01->execute();
			$result = $stmt_01->fetchAll();

			if(count($result) != 0)
				die("The username is already in use!");
			
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}

		//create user
		try
		{
			$stmt_02 = $dbh->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
			$stmt_02->bindParam(':username', $username);
			$stmt_02->bindParam(':password', $password);
			$stmt_02->execute();

			echo "Successful registration";
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}
	}
	else
		die("Enter username and password");
?>
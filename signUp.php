<?php

	require_once 'init.php';

	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	
	//get username and password
	if($username && $password && $confirmPassword)
	{
		if($username == " ")
			die("Username must have at least one letter");

		if($password != $confirmPassword)
			die("Incorrect password!");

		//verify if the username is already taken
		try
		{
			$stmt_01 = $dbh->prepare("SELECT * FROM users WHERE username ='$username'");
			$stmt_01->execute();
			$result = $stmt_01->fetchAll();

			if(count($result) != 0)
			{

				//print_r($result);

				die("The username is already in use!");
			}
				
			
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}

		//create user
		try
		{
			$stmt_02 = $dbh->prepare('INSERT INTO users (username, password, age, gender, email) 
				VALUES (:username, :password, :age, :gender, :email)');
			$stmt_02->bindParam(':username', $username);
			$stmt_02->bindParam(':password', md5($password));
			$stmt_02->bindParam(':age', $age);
			$stmt_02->bindParam(':gender', $gender);
			$stmt_02->bindParam(':email', $email);
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
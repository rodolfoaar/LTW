<?php
	//establish connection to the database
	try
	{
		$dbh = new PDO('sqlite:phpLogin.db');
		$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
		die($e->getMessage());
	}
?>
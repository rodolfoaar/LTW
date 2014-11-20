<?php
	
	require_once 'init.php';

	$user=$_POST['user'];

	try
	{
		$stmt = $dbh->prepare("SELECT * FROM polls WHERE user = '$user'");
		$stmt->execute();
		$userPolls = $stmt->fetchAll();
	}
	catch (PDOException $e)
	{
		die($e->getMessage());
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>LTW Project</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>

		<h1 id="test"> hey I am the user <?php echo $user ?>! </h1><br>

		<?php
			foreach ($userPolls as $row)
			{
				?> <a href="#teste"> <?php echo $row['title'];?></a><br> <?php
			}
		?>
		

		<!--
		<div class="poll">
			<div class="pollQuestion">
				Poll question
			</div>
			<form action="vote.php" method="post">
				<div class="pollOptions">
					<div class="pollOption">
						<input type="radio" name="choice" value="1" id="c1">
						<label for="c1">Choise 1</label>
					</div>
				</div>
				<input type="submit" value="Submit choices!">
				<input type="hiden" name="poll" value="1">
			</form>
		</div>
		!-->
	</body>
</html>
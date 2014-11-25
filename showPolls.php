<?php
  ///////////////////////////
  //connection to data base//
  ///////////////////////////
  try
  {
    $dbh = new PDO('sqlite:polls.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch (PDOException $e)
  {
    die($e->getMessage());
  }
  /////////////////
  //get all polls//
  /////////////////
  try
    {
      $stmtPoll= $dbh->prepare('SELECT * FROM polls');
      $stmtPoll->execute();
      $resultPoll = $stmtPoll->fetchALL();
    }
    catch (PDOException $e)
    {
      die($e->getMessage());
    }

?>

<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  </head>
  <body>
    <form action="answerPoll.php" method="POST">
      <select id="polls" name="pollsTitles">
        <?php
          foreach ($resultPoll as $poll)
          {
            ?><option><?=$poll['title']?></option><?php
          }
        ?>
      </select>
      <input type="submit" value="Submit">
    </form>
    </body>
</html>
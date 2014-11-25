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
      $stmt= $dbh->prepare('SELECT * FROM polls');
      $stmt->execute();
      $result = $stmt->fetchALL();
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
    <script>
    </script>
  </head>
  <body>
    <select id="colors">
      <?php
        foreach ($result as $poll)
        {
          ?><option><?=$poll['title']?></option><?php
        }
      ?>
    </select>
    </body>
</html>
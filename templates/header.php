<!DOCTYPE html>
<html>
<head>
    <title>Online Polls</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/create_poll.js"></script>
    <script src="js/rtc.js"></script>
    <script src="js/lastPolls.js"></script>
    <script src="js/search.js"></script>

</head>
<body>
    <header>
        <div id="timeClock"></div>
        <h1>Online Polls</h1>
        <h2>Welcome to the best online polls, where users can create, share, and manage polls!</h2>

        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="showPolls.php">Search</a></li>
                <li><a href="account.php">Account</a></li>
                <?php
                if(isset($_SESSION['status']) && $_SESSION['status'] === 'authorized') {
                    echo('<li><a href="log_out.php">SignOut</a></li>');
                }
                ?>
            </ul>
        </nav>
        <?php
        if(isset($_SESSION['username'])) {
            echo('<h4>User: '.$_SESSION['username'].'</h4>');
        }
        ?>
    </header>
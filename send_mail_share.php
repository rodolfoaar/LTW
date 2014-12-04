<?php

$name = $_POST['name'];
$to = $_POST['to'];
$pollLink = $_POST['pollLink'];

$headers = "From: webmaster@onlinepolls.com";
$subject = "LTW Online Poll share";
$txt = "Hello,\n\n" . $name . " wants to share a poll with you at:\n" . $pollLink . "\n\nDon't miss it and give your opinion.";

if($name != "" && $to != "" && $pollLink != "") {
	mail($to, $subject, $txt, $headers);
	echo("The e-mail was successfully sent.");
}
else
	echo("Inssuficient information to send the e-mail!");

?>
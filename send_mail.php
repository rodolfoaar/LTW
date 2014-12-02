<?php

function sendMail($from, $to, $cc, $bcc, $subject, $msg)
{
	//$headers = "From: webmaster@LTWmail.com" . "\r\n" . "CC: " . $userInfo['email'];
	//$to = $userInfo['email'];
	//$subject = "LTW Online Polls signUp";
	//$txt = "You successfully signUp to LTW Online Polls with username: " . $userInfo['username'];
	
	if($cc != "" && $bcc != "")
		$headers = "From: " . $from . "\r\n" . "CC: " . $cc . "\r\n" . "BCC: " . $bcc;
	else if ($cc != "")
		$headers = "From: " . $from . "\r\n" . "CC: " . $cc;
	else if ($bcc != "")
		$headers = "From: " . $from . "\r\n" . "BCC: " . $bcc;
	else
		$headers = "From: " . $from;
	
	$txt = "" . $msg;
	
	return mail($to, $subject, $txt, $headers);
}

?>
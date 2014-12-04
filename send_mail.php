<?php

function sendMail($from, $to, $cc, $bcc, $subject, $msg)
{	
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
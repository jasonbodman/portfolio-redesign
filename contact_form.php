/* This form was built from a guide at
https://www.quackit.com/html/codes/html_form_to_email.cfm */

<?php

$webmaster_email = 'hello@jasonbodman.com';

$feedback_page = "index.html";
$error_page = "error.html";
$thankyou_page = "thankyou.html";

$email_address = $_REQUEST['email'] ;
$subject = "New Project Request - Form Submission" ;
$message = $_REQUEST['message'] ;
$name = $_REQUEST['name'] ;
$phone = $_REQUEST['phone'] ;
$website = $_REQUEST['website'] ;
$msg =
"Name: " . $name . "\r\n" .
"Email: " . $email_address . "\r\n" .
"Phone: " . $phone. "\r\n" .
"Website: " . $website. "\r\n" .
"Message: " . $message ;


function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}

if (empty($name) || empty($email_address) || empty($phone)) {
header( "Location: $error_page" );
}

else {

	mail( "$webmaster_email", "$subject", $msg );

	header( "Location: $thankyou_page" );
}
?>

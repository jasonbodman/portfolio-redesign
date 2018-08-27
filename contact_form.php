<?php
if(! isset($_POST['submit']) ) echo '<script type="text/javascript">alert("The form was blank and no data was submitted");</script>' ;
 
if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
{
     //your site secret key
    $secret = '6LdHcmwUAAAAAK6n07_RvmIDhZTvIncCrgX89KMd';
    //get verify response data
    $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    $response = json_decode($verify);
    if($response->success)
    {
        echo '<script type="text/javascript">alert("Verification Success");</script>' ;
        echo 'Your submitted form : <br>';
        echo 'Name : '.$_POST['name'].'<br>';
        echo 'Address : '.$_POST['address'].'<br>';
        echo 'Email : '.$_POST['email'].'<br>';
        echo 'Thanks You!';
        
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
 

    }
    else
    {
        echo '<script type="text/javascript">document.location="error.html"</script>' ;
    }
}
else
{
    echo '<script type="text/javascript">document.location="index.html"</script>';
}

?>

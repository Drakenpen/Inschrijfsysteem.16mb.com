<?php
// TO INSTALL PHPMAILER
// 1. open dosbox, enter your app folder, type composer require phpmailer/phpmailer <enter>
// (will download lots of things to /vendor folder)
// 2. in the dosbox, type composer require league/oauth2-client <enter>
// (will download lots of things to /vendor folder)
// TO MAKE THIS WORK WITH YOUR GMAIL ACCOUNT
// 0. If you are logged in at gmail with your own account, please log out first
// 1. log into gmail account "ictambw@gmail.com" (user=ictambw@gmail.com, password=Studentje1) 
// 2. navigate to https://www.google.com/settings/u/0/security/lesssecureapps and allow non-secure apps
// 3. navigate to https://accounts.google.com/b/0/DisplayUnlockCaptcha and confirm
// 4. now try to run this page again
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Europe/Amsterdam');
require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "ictambw@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "Studentje1";
//Set who the message is to be sent from
$mail->setFrom('ictambw@gmail.com', 'ICTA MBW');
//Set an alternative reply-to address
$mail->addReplyTo('ictambw@gmail.com', 'ICTA MBW');
//Set who the message is to be sent to
$mail->addAddress('petersnoek@davinci.nl', 'Peter Snoek');
//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('views/sendmail.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
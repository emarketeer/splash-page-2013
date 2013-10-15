<?php

//This single page is a tempory mail router and form processer for the eMarketeer Australia splash page.
//Nothing complicated required.

//Just a couple of definitions.
$enquiry_data['receipient'] = "info@emarketeer.com.au";
$enquiry_data['timestamp'] = date("Y-m-d h:m:s");

//Grab the post information.
if ( empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) ) {
	//All fields are required.
	die("-1");
}

//Set the mail information.
$enquiry_data['name'] = stripslashes( $_POST['enquiry_name'] );
$enquiry_data['reply_to'] = stripslashes( $_POST['email'] );
$enquiry_data['raw_message'] = stripslashes( $_POST['message'] );

//Ensure the reply_to address is valid.
if (! preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $enquiry_data['reply_to']) ) {
	die("-2");
}

$enquiry_data['subject'] = "Website enquiry from " . $enquiry_data['name'] . " - " . $enquiry_data['timestamp'];
$enquiry_data['message'] = "A new enquiry has been submitted!\r\n\r\nName: " . $enquiry_data['name'] . "\r\nEmail: " . $enquiry_data['reply_to'] . "\r\n\r\n" . $enquiry_data['raw_message'] . "\r\n\r\n\r\nThis message was submitted on " . $enquiry_data['timestamp'];
$enquiry_data['headers'] = 'From: webmaster@emarketeer.com.au' . "\r\n" . 'Reply-To: ' . $enquiry_data['reply_to'] . "\r\n" . 'X-Mailer: PHP/' . phpversion();

//Send the mail.
//We're just using PHP sendmail for now.


if ( @mail( $enquiry_data['receipient'], $enquiry_data['subject'], $enquiry_data['message'], $enquiry_data['headers'] ) ) {
	die("1");
} else {
	die("-3");
}

//Fin.

?>
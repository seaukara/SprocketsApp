<?php
/*
config.php

stores configuration information for our web application

*/

//removes header already sent errors
ob_start();

define('DEBUG',TRUE); #we want to see all errors

include 'credentials.php';//stores database info
include 'common.php';//stores favorite functions

// echo DB_USER;
// die;

//prevents date errors
date_default_timezone_set('America/Los_Angeles');

//create config object
$config = new stdClass;


//contants are global, they also can't change
//create default page identifier
define('THIS_PAGE', basename($_SERVER['PHP_SELF']));

//set website defaults
$config->title = THIS_PAGE;
$config->banner = 'Sprockets';

switch(THIS_PAGE) {
	
	case 'contact.php':
		$config->title = 'Contact Page';
	break;
	case 'appointment.php':
		$config->title = 'Appointment Page';
		$config->banner = 'Das Spokkets';
	break;
	case 'template.php':
		$config->title = 'Template Page';
	break;

}

//no dollar sign becuase its not a variable, its a costant
//echo THIS_PAGE;

//$_ is a super global in php
//echo basename($_SERVER['PHP_SELF']);
//die;

?>
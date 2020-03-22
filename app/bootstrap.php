<?php 

// Load PHPmailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader

require 'vendor/autoload.php';


// Load config 
require_once 'config/config.php'; 

// Load helpers
require_once 'helpers/url_helper.php'; 
require_once 'helpers/session_helper.php'; 
require_once 'helpers/validate_helper.php'; 

// Setup cuurent timezone

date_default_timezone_set('Europe/Helsinki');


// Load Libraries 
/* require_once 'libraries/Core.php'; 
require_once 'libraries/Controller.php'; 
require_once 'libraries/Database.php'; 
 */

// Autolaod Core Libraries 

spl_autoload_register(function( $className ) {
  require_once 'libraries/' . $className .'.php'; 
});  
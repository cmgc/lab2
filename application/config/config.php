<?php


error_reporting(E_ALL);
ini_set("display_errors", 1);


define('URL', 'http://.../');


define('LIBS_PATH', 'application/libs/');
define('CONTROLLER_PATH', 'application/controllers/');
define('VIEWS_PATH', 'application/views/');
define('MODELS_PATH', 'application/models/');

define('COOKIE_RUNTIME', 1209600);
define('COOKIE_DOMAIN', '.localhost');



define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');




define("PHPMAILER_DEBUG_MODE", 0);
#define("EMAIL_USE_SMTP", false);

/**
* Configuration for: Error messages and notices
 */

define("FEEDBACK_UNKNOWN_ERROR", "Unknown error occurred!");
define("FEEDBACK_PASSWORD_WRONG_3_TIMES", "You have typed in a wrong password 3 or more times already. Please wait 30 seconds to try again.");
define("FEEDBACK_PASSWORD_WRONG", "Password was wrong.");
define("FEEDBACK_LOGIN_FAILED", "Login failed.");

define("FEEDBACK_USERNAME_FIELD_EMPTY", "Username field was empty.");
define("FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN", "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters.");
define("FEEDBACK_CAPTCHA_WRONG", "The entered captcha security characters were wrong.");
define("FEEDBACK_PASSWORD_REPEAT_WRONG", "Password and password repeat are not the same.");

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/////////////// Error Constants /////////////////

define('SALARY_REVERSAL_DENIED', 'SALARY_REVERSAL_DENIED');


/////////////// Unit ID Constants /////////////////

define('DEFAULT_UNIT', 'K1'); // Piece


/////////////// Report Type Constants /////////////////

define('REPORT_TYPE_DAILY', 'REPORT_TYPE_DAILY');
define('REPORT_TYPE_MONTHLY', 'REPORT_TYPE_MONTHLY');
define('REPORT_TYPE_RANGE', 'REPORT_TYPE_RANGE');


/////////////// Transaction Status ID Constants /////////////////

define('TRX_UNPAID', 'K1');
define('TRX_INCOMPLETE', 'K2');
define('TRX_CLEAR', 'K3');
define('TRX_SUSPENDED', 'K4');
define('TRX_RETURNED', 'K5');

/////////////// Bill Type ID Constants /////////////////

define('BILL_TYPE_PURCHASE', 'K1');
define('BILL_TYPE_SALE', 'K2');
define('BILL_TYPE_PURCHASE_RETURN', 'K3');
define('BILL_TYPE_SALE_RETURN', 'K4');

/////////////// Payment Method ID Constants /////////////////

define('PAYMENT_METHOD_CASH', 'K1');
define('PAYMENT_METHOD_CHEQUE', 'K2');

/////////////// Expense Type ID Constants /////////////////

define('EXPENSE_TYPE_OTHER', 'K1');
define('EXPENSE_TYPE_PURCHASE', 'K2');
define('EXPENSE_TYPE_SALE_RETURN', 'K3');
define('EXPENSE_TYPE_SALARY', 'K4');
define('EXPENSE_TYPE_BONUS', 'K5');

/////////////// Expense Type ID Constants /////////////////

define('INCOME_TYPE_OTHER', 'K1');
define('INCOME_TYPE_SALE', 'K2');
define('INCOME_TYPE_PURCHASE_RETURN', 'K3');

/////////////// Customer ID Constants /////////////////

define('WALK_IN_CUSTOMER_ID', 'K1');

/////////////// Employee Status ID Constants /////////////////

define('EMPLOYEE_STATUS_ACTIVE', 'K1');
define('EMPLOYEE_STATUS_DEACTIVE', 'K2');
define('EMPLOYEE_STATUS_DELETED', 'K3');
define('EMPLOYEE_STATUS_RETIRED', 'K4');
define('EMPLOYEE_STATUS_SUSPENDED', 'K5');
define('EMPLOYEE_STATUS_DECEASED', 'K6');

/////////////// Manager Role ID Constants /////////////////

define('MANAGER_ROLE_AUTO_CRON', 'K1');
define('MANAGER_ROLE_SUPERADMIN', 'K2');
define('MANAGER_ROLE_ADMIN', 'K52');
define('MANAGER_ROLE_ASSISTANT', 'K53');
define('MANAGER_ROLE_SALESMAN', 'K54');

/////////////// Disbursement Type Constants /////////////////

define('DISBURSEMENT_TYPE_SALARY', 'K1');
define('DISBURSEMENT_TYPE_BONUS', 'K2');
define('DISBURSEMENT_TYPE_PROFIT_SHARE', 'K3');

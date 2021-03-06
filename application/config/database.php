<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = '10.65.52.22';//:1433';
$db['default']['username'] = 'sa';
$db['default']['password'] = 'TIGO';
$db['default']['database'] = 'TIGOCENTRAL';
$db['default']['dbdriver'] = 'sqlsrv';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = TRUE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

$db['centromedellin']['hostname'] = '10.74.28.242';//10.74.31.30
$db['centromedellin']['username'] = 'sa';
$db['centromedellin']['password'] = 'TIGO';
$db['centromedellin']['database'] = 'DIGITURNO13';
$db['centromedellin']['dbdriver'] = 'sqlsrv';
$db['centromedellin']['dbprefix'] = '';
$db['centromedellin']['pconnect'] = FALSE;
$db['centromedellin']['db_debug'] = TRUE;
$db['centromedellin']['cache_on'] = TRUE;
$db['centromedellin']['cachedir'] = '';
$db['centromedellin']['char_set'] = 'utf8';
$db['centromedellin']['dbcollat'] = 'utf8_general_ci';
$db['centromedellin']['swap_pre'] = '';
$db['centromedellin']['autoinit'] = TRUE;
$db['centromedellin']['stricton'] = FALSE;

$db['bd_cded_cde_pda1']['hostname'] = '10.66.6.240';//10.74.31.30
$db['bd_cded_cde_pda1']['username'] = 'ricardo';
$db['bd_cded_cde_pda1']['password'] = 'ricardo';
$db['bd_cded_cde_pda1']['database'] = 'bd_cded_cde_pda';
$db['bd_cded_cde_pda1']['dbdriver'] = 'mysql';
$db['bd_cded_cde_pda1']['dbprefix'] = '';
$db['bd_cded_cde_pda1']['pconnect'] = FALSE;
$db['bd_cded_cde_pda1']['db_debug'] = TRUE;
$db['bd_cded_cde_pda1']['cache_on'] = FALSE;
$db['bd_cded_cde_pda1']['cachedir'] = '';
$db['bd_cded_cde_pda1']['char_set'] = 'utf8';
$db['bd_cded_cde_pda1']['dbcollat'] = 'utf8_general_ci';
$db['bd_cded_cde_pda1']['swap_pre'] = '';
$db['bd_cded_cde_pda1']['autoinit'] = TRUE;
$db['bd_cded_cde_pda1']['stricton'] = FALSE;
$db['bd_cded_cde_pda1']['port'] = 3306;

$db['gtr']['hostname'] = '10.66.6.240';//10.74.31.30
$db['gtr']['username'] = 'ricardo';
$db['gtr']['password'] = 'ricardo';
$db['gtr']['database'] = 'gtr';
$db['gtr']['dbdriver'] = 'mysql';
$db['gtr']['dbprefix'] = '';
$db['gtr']['pconnect'] = FALSE;
$db['gtr']['db_debug'] = TRUE;
$db['gtr']['cache_on'] = FALSE;
$db['gtr']['cachedir'] = '';
$db['gtr']['char_set'] = 'utf8';
$db['gtr']['dbcollat'] = 'utf8_general_ci';
$db['gtr']['swap_pre'] = '';
$db['gtr']['autoinit'] = TRUE;
$db['gtr']['stricton'] = FALSE;
$db['gtr']['port'] = 3306;

/* End of file database.php */
/* Location: ./application/config/database.php */
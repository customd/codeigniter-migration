<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Enable/Disable Migrations
|--------------------------------------------------------------------------
|
| Migrations are disabled by default but should be enabled 
| whenever you intend to do a schema migration.
|
*/
$config['migration_enabled'] = FALSE;


/*
|--------------------------------------------------------------------------
| Migrations version
|--------------------------------------------------------------------------
|
| This is used to set migration version that the file system should be on.
| If you run $this->migration->latest() this is the version that schema will
| be upgraded / downgraded to.
|
*/
$config['migration_version'] = 0;


/*
|--------------------------------------------------------------------------
| Migrations Path
|--------------------------------------------------------------------------
|
| Path to your migrations folder.
| Typically, it will be within your application path.
| Also, writing permission is required within the migrations path.
|
*/
$config['migration_path'] = '';


/*
|--------------------------------------------------------------------------
| Migrations Basic Authentication
|--------------------------------------------------------------------------
|
| Use this to require authentication before running migrations
| through the 'migrate' controller.
|
|-------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['migration_realm']		The authentication realm to use. Set to FALSE to disable Basic Authentication.
|	['migration_user']		The username used to access migrations
|	['migration_password']	The password used to access migrations
|	
*/
$config['migration_realm']		= FALSE;
$config['migration_user']		= '';
$config['migration_password']	= '';


/* End of file migration.php */
/* Location: ./application/config/migration.php */
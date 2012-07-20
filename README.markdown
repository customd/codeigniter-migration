Migration Controller
====================
### By Sam Sehnert, [Digital Fusion](http://teamdf.com/) 2012

This is a [CodeIgniter](http://codeigniter.com/) controller & view which acts as a drop-in
controller for the built-in [Migration](http://codeigniter.com/user_guide/libraries/migration.html) class.

It provides a basic interface for migrating to specific file versions, and allows you to step through migration
versions one at a time.


Installation
------------

Simply copy the files from the download into their respective directories under the application directory.

- application/controllers/migrate.php
- application/views/migrate/migrate.php


And optionally use the config file for Basic Authentication when accessing the migrate controller.

- application/config/migration.php


Basic Authentication
--------------------

You can optionally protect the migrations controller with Basic Authentication under a realm by simply
adding these options into the Migrations config file.

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
	$config['migration_realm']		= 'CodeIgniter Migration';  // You can change this to whatever you like.
	$config['migration_user']		= '';
	$config['migration_password']	= '';
	
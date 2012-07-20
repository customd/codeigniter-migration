<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Migration Controller
 *
 * provides a basic interface for migrating to specific database versions,
 * and allows you to step through migration versions one at a time.
 * 
 * @package		Migration Controller
 * @author		Sam Sehnert, (c) Digital Fusion (http://teamdf.com/) 2012
 * @version		1.0.0
 * @license		MIT (http://opensource.teamdf.com/license/)
 */
class Migrate extends CI_Controller
{
	public function __construct()
	{
		// Create the controller.
		parent::__construct();
		
		// Load the migration config file.
		$this->config->load( 'migration', true );
		
		// Get the migration realm, user and password.
		$user		= $this->config->item('migration_user',		'migration');
        $password	= $this->config->item('migration_password',	'migration');
		$realm		= $this->config->item('migration_realm',	'migration');
		
		// If we've specified a realm, require basic authentication.
		if( $realm !== false )
		{
			// Check if the user matches what's in our config file.
	        if ( !isset($_SERVER['PHP_AUTH_USER']) || ( $_SERVER['PHP_AUTH_USER'] !== $user || $_SERVER['PHP_AUTH_PW'] !== $password ) )
	        {
	           $this->output->set_header('WWW-Authenticate: Basic realm="'.$realm.'"');
	           $this->output->set_header('HTTP/1.0 401 Unauthorized');
	           $this->output->set_output( "Please enter a valid username and password" );
	           $this->output->_display();
	           exit;
	        }
		}
		
		// Load the migration library.
		$this->load->library('migration', $this->config->item('migration') );
	}
	
	/**
	 * Migrate to the current version as set in the config file.
	 *
	 * @return void;
	 * @output error messages.
	 */
	public function index()
	{
		$this->_show_message( 'The database is currently at version '.$this->_get_version().'.', 200, 'Migration' );
	}
	
	/**
	 * Shortcut for 'migrate/to/current/'.
	 */
	public function current()
	{
		$this->to('current');
	}
	
	/**
	 * Migrate to the passed version as set in the config file.
	 *
	 * @return void;
	 * @output error messages.
	 */
	public function to( $version = null )
	{
		// Make sure we've specified a version.
		if( is_null( $version ) ) $this->_show_message( 'Please specify a valid migration version.' );
		
		// Set the 'current' version from the config file.
		if( $version == 'current' ) $version = $this->_config_version;
		
		if( $version == $this->_get_version() )
		{
			return $this->_show_message( 'The database is already at the selected version.', 200, 'Migration Complete' );
		}
		
		// If the migration can't be updated to $version.
		if( !$this->migration->version( $version ) )
		{
			return $this->_show_message( $this->migration->error_string(), 500, 'Migration Error', $version );
		}
		
		if( $this->_get_version() < $version )
		{
			return $this->_show_message( 'This migration version doesn\'t exist. The database is now at the latest version.', 200, 'Migration Complete', $version );
		}
		else
		{
			return $this->_show_message( 'The database has been migrated to version '.$this->_get_version().'.', 200, 'Migration Complete', $version );
		}
	}
	
	/**
	 * Show a message.
	 */
	function _show_message( $message, $code = 500, $title = 'Migration Error', $to = false )
	{
		// Get the current migration version.
		$current = $this->_get_version();
		
		// Use output lib to set header and response.
		$this->output->set_status_header($code);
		$this->output->set_output(
			$this->load->view('migrate/migrate', array(
				'title'		=> $title,
				'message'	=> $message,
				'ideal'		=> $this->_config_version(),
				'current'	=> $current,
				'to'		=> $to OR $current
			),true)
		);
	}
	
	/**
	 * Gets protected variable for the current version we're updating to.
	 */
	public function _config_version()
	{
		return $this->config->item('migration_version','migration');
	}
	
	/**
	 * Gets result of a protected function for the current schema version.
	 */
	public function _get_version()
	{
		$row = $this->db->get('migrations')->row();
		return $row ? $row->version : 0;
	}
}

/* End of file migrate.php */
/* Location: ./application/controllers/migrate.php */
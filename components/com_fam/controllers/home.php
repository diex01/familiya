<?php
/**
* @version		$Id: #name#.php 2014-02-16 surinder $
* @package		Fam
* @subpackage 	Controllers
* @copyright	Copyright (C) 2014, Surinder Singh. All rights reserved.
* @license 		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class FamControllerHome extends FamController {
	/**
	 * Constructor
	 */
	protected $default_view = 'home'; 
	 
	public function __construct($config = array ())	{
		parent::__construct($config);
	}
	
	public function display() {		
		//your custom code
		parant::display();
	}		
}// class
?>
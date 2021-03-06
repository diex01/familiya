<?php
/**
 * B3 entry point file for b3 Component
 * 
 * @package    B3
 * @subpackage com_b3
 * @license  !license!
 *
 * Created with Marco's Component Creator for Joomla! 2.5
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


// import joomla controller library
jimport('joomla.application.component.controller');


$ctrl='B3';
$input = JFactory::getApplication()->input;
// Require specific controller if requested
if($controller = $input->getWord('controller')) {
	$ctrl = $controller;
}else{
	// define default view if you need routing...
	//JRequest::setVar( 'view', '***' ); // insert here!! 
}
 
// Get an instance of the required controller
$controller = JControllerLegacy::getInstance($ctrl);
 
// Perform the Request task

$controller->execute($input->getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();

?>

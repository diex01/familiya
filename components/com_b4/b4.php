<?php
/**
 * B4 entry point file for b4 Component
 * 
 * @package    B4
 * @subpackage com_b4
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


$ctrl='B4';
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

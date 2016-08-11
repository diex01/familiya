<?php
/**
 * B4 View for com_b4 Component
 * 
 * @package    B4
 * @subpackage com_b4
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 1.6
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the B4 Component
 *
 * @package	Joomla.Components
 * @subpackage	B4
 */
class B4ViewRooms extends JViewLegacy{
	function display($tpl = null){
		$data = $this->get('Data');
		$this->assignRef('data', $data);
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))){
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
			return false;
		}
		
		parent::display($tpl);
	}
}
?>

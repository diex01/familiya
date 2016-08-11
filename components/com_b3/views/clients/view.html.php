<?php
/**
 * B3 View for com_b3 Component
 * 
 * @package    B3
 * @subpackage com_b3
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 1.6
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the B3 Component
 *
 * @package	Joomla.Components
 * @subpackage	B3
 */
class B3ViewClients extends JViewLegacy{
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

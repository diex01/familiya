<?php
/**
 * Booking View for com_booking Component
 * 
 * @package    Booking
 * @subpackage com_booking
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 1.6
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Booking Component
 *
 * @package	Joomla.Components
 * @subpackage	Booking
 */
class BookingViewRooms extends JViewLegacy{
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

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
 * @package		Booking
 * @subpackage	Components
 */
class BookingViewRoomslist extends JViewLegacy{
	function display($tpl = null){
		$app = JFactory::getApplication();
		/*
		$params =& JComponentHelper::getParams( 'com_booking' );
		$params =& $app->getParams( 'com_booking' );	
		$dummy = $params->get( 'dummy_param', 1 ); 
		*/
	
		$data = $this->get('Data');
		$this->assignRef('data', $data);
		
		$pagination = $this->get('Pagination');
		$this->assignRef('pagination', $pagination);

		parent::display($tpl);
	}
}
?>

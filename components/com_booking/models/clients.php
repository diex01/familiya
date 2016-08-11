<?php
/**
 * Booking Model for Booking Component
 * 
 * @package    Booking
 * @subpackage com_booking
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 2.5
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
 * Booking Model
 *
 * @package    Joomla.Components
 * @subpackage 	Booking
 */
class BookingModelClients extends JModelItem{

	/**
	 * Clients data array for tmp store
	 *
	 * @var array
	 */
	protected $_data;
	
	/**
	 * Gets the data
	 * @return mixed The data to be displayed to the user
	 */
	public function getData(){
		if (empty( $this->_data )){
			$id = JRequest::getInt('id',  0);
			$db = JFactory::getDBO();
			$query = "SELECT * FROM `#___clients` where `id` = {$id}";
			$db->setQuery( $query );
			$this->_data = $db->loadObject();
		}
		return $this->_data;
	}
}

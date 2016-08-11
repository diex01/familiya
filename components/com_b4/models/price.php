<?php
/**
 * B4 Model for B4 Component
 * 
 * @package    B4
 * @subpackage com_b4
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
 * B4 Model
 *
 * @package    Joomla.Components
 * @subpackage 	B4
 */
class B4ModelPrice extends JModelItem{

	/**
	 * Price data array for tmp store
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
			$query = "SELECT * FROM `#__price` where `id` = {$id}";
			$db->setQuery( $query );
			$this->_data = $db->loadObject();
		}
		return $this->_data;
	}
}

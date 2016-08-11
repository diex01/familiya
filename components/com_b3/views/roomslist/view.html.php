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
 * @package		B3
 * @subpackage	Components
 */
class B3ViewRoomslist extends JViewLegacy{
	function display($tpl = null){
		$app = JFactory::getApplication();
		/*
		$params =& JComponentHelper::getParams( 'com_b3' );
		$params =& $app->getParams( 'com_b3' );	
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

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
 * @package		B4
 * @subpackage	Components
 */
class B4ViewPricelist extends JViewLegacy{
	function display($tpl = null){
		$app = JFactory::getApplication();
		/*
		$params =& JComponentHelper::getParams( 'com_b4' );
		$params =& $app->getParams( 'com_b4' );	
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

<?php
/**
 * Family View for com_family Component
 * 
 * @package    Family
 * @subpackage com_family
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 1.6
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Family Component
 *
 * @package		Family
 * @subpackage	Components
 */
class FamilyViewClientslist extends JViewLegacy{
	function display($tpl = null){
		$app = JFactory::getApplication();
		/*
		$params =& JComponentHelper::getParams( 'com_family' );
		$params =& $app->getParams( 'com_family' );	
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

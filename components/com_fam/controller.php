<?php
/**
 * @module		com_fam
 * @script		fam.php
 * @author-name	surinder
 * @copyright	Copyright (C) 2014, Surinder Singh. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controller library
jimport('joomla.application.component.controller');
 
/**
 * Fam Component Controller
 */
class FamController extends JControllerLegacy
{
	protected $default_view = 'home';
}

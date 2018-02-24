<?php
/*
 * @package Brute Force Stop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2014 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

$ds = DIRECTORY_SEPARATOR;
JLoader::register('BfstopHelper', dirname(__FILE__).$ds.'helpers'.$ds.'bfstop.php');

jimport('joomla.application.component.controller');
require_once(JPATH_ADMINISTRATOR.$ds.'components'.$ds.'com_bfstop'.$ds.'helpers'.$ds.'log.php');

$controller = JControllerLegacy::getInstance('bfstop');
$jinput = JFactory::getApplication()->input;
$task = $jinput->get('task', "", 'STR');
$controller->execute($task);
$controller->redirect();

<?php
/*
 * @package Brute Force Stop Administration for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2013 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

$controller = JController::getInstance('bfstop');
$jinput = JFactory::getApplication()->input;
$task = $jinput->get('task', "", 'STR');
$controller->execute($task);
$controller->redirect();
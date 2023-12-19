<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla!
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

$controller = Joomla\CMS\MVC\Controller\BaseController::getInstance('bfstop');
$input = $JFactory::getApplication()->input;
$cmd = $input->get('task', '', 'cmd');
$controller->execute($cmd);
$controller->redirect();


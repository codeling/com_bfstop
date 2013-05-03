<?php
// No direct access
defined('_JEXEC') or die('Direct Access to this script is not allowed.');

// Require base controller:
jimport('joomla.application.component.controller');

$controller = JController::getInstance('bfstop');

$controller->execute( JRequest::getCmd('task') );
$controller->redirect();


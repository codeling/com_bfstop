<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');
jimport('plugins.system.bfstop.helper_log');
require_once JPATH_COMPONENT.DIRECTORY_SEPARATOR.'helpers'.
	DIRECTORY_SEPARATOR.'bfstop.php';

class bfstopController extends JControllerLegacy
{
	function display($cachable = false, $urlparams = false)
	{
		$input = JFactory::getApplication()->input;
		$view = $input->getCmd('view', 'blocklist');
		BfstopHelper::addSubmenu($view);
		$input->set('view', $view);
		parent::display($cachable);
	}
	function unblock()
	{
		$logger = new BFStopLogger(true);
		$input =  JFactory::getApplication()->input;
		$id = $input->getInt('id', -1);
	        $model = $this->getModel('blocklist');
		$message = $model->unblock($id, $logger);
		// redirect to blocklist view
		$view = $this->getView('blocklist', 'html');
		$view->setModel($model, true);
	        $mainframe = JFactory::getApplication();
		$mainframe->enqueueMessage($message);
		$view->display();
	}
}

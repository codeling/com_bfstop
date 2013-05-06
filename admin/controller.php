<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');
jimport('plugins.system.bfstop.helper_log');

class bfstopController extends JController
{
	function display($cachable = false, $urlparams = false)
	{
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'blocklist'));
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

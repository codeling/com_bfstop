<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');

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
		$input =  JFactory::getApplication()->input;
		$id = $input->getInt('id', -1);
		if ($id > 0)
		{
			// unblock via model
		} else {
			// log!
		}
		// redirect to blocklist view
	        $model = $this->getModel('blocklist');
		$view = $this->getView('blocklist', 'html');
		$view->setModel($model, true);
	        $mainframe = JFactory::getApplication();
		$mainframe->enqueueMessage('Unblock not implemented yet.');
		$view->display();
	}
}

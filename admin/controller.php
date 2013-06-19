<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');

class bfstopController extends JControllerLegacy
{
	function display($cachable = false, $urlparams = false)
	{
		$input = JFactory::getApplication()->input;
		$view = $input->getCmd('view', 'blocklist');
		BfstopHelper::addSubmenu($view);
		$input->set('view', $view);
		$this->checkForAdminUser();
		parent::display($cachable);
	}
	function checkForAdminUser()
	{
		$db = JFactory::getDBO();
		$query = "SELECT COUNT(*) FROM #__users u WHERE u.username='admin'";
		$db->setQuery($query);
		if ($db->loadResult() > 0)
		{
		        $application = JFactory::getApplication();
			$application->enqueueMessage(JText::_('WARNING_ADMIN_USER_EXISTS'), 'warning');
		}
	}
}

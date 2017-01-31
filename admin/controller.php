<?php
/*
 * @package Brute Force Stop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2014 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

// import Joomla controller library
jimport('joomla.application.component.controller');

require_once(JPATH_SITE.DIRECTORY_SEPARATOR.'plugins'
          .DIRECTORY_SEPARATOR.'system'
          .DIRECTORY_SEPARATOR.'bfstop'
          .DIRECTORY_SEPARATOR.'helpers'
          .DIRECTORY_SEPARATOR.'htaccess.php');

class bfstopController extends JControllerLegacy
{
	function display($cachable = false, $urlparams = false)
	{
		$input = JFactory::getApplication()->input;
		$view = $input->getCmd('view', 'blocklist');

		$this->checkForAdminUser();
		$htaccessWorking = $this->checkWhetherHtAccessWorks();

		BfstopHelper::addSubmenu($view, $htaccessWorking);
		$input->set('view', $view);
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
			$application->enqueueMessage(JText::_('COM_BFSTOP_WARNING_ADMIN_USER_EXISTS'), 'warning');
		}
	}

	function checkWhetherHtAccessWorks()
	{
		$htaccess = new BFStopHtAccess(JPATH_ROOT, null);
		$req = $htaccess->checkRequirements();
		if (!$req['apacheserver'] ||
			!$req['found'] ||
			!$req['readable'] ||
			!$req['writeable'])
		// TODO: add check whether .htaccess actually is effective!
		{
		        $application = JFactory::getApplication();
			$application->enqueueMessage(JText::_('COM_BFSTOP_WARNING_HTACCESS_NOT_WORKING')
				// .'found='.$req['found'].', readable='.$req['readable'].', writeable='.$req['writeable'].', apache='.$req['apacheserver']
				, 'warning');
			return false;
		}
		return true;
	}
}
